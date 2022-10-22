<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Leave_m extends CI_Model {

    /*-------------------------------------------FETCH DATA-------------------------------------------*/
    /*-------------------------------------------FETCH DATA-------------------------------------------*/
    /*-------------------------------------------FETCH DATA-------------------------------------------*/

    // รายชื่อบริษัท
    public function listTimeleave() {
        if(isset($_SESSION['Person_id'])){$Person_id = $_SESSION['Person_id'];}else{$Person_id='0';}     
        $this->db->select('*');
        $this->db->from('time_leave,person');
        $where = "time_leave.Person_id = person.Person_id AND time_leave.Person_id = $Person_id";
        $this->db->where($where);
        // คำสั่ง limit
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 5;
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query->result_array();
    }
    public function listTimeleave_count(){
        if(isset($_SESSION['Person_id'])){$Person_id = $_SESSION['Person_id'];}else{$Person_id='0';}     
        $this->db->select('*');
        $this->db->from('time_leave,person');
        $where = "time_leave.Person_id = person.Person_id AND time_leave.Person_id = $Person_id";
        $this->db->where($where);
        $query =$this->db->get();
        return $query->num_rows();
    }
    //ดึงข้อมูล Time ตาม Time_id ที่ได้รับเข้ามา เพื่อเอาไปแสดงในหน้า Time_detail
    public function readTimeleavedetail($date,$Person_id)
    {
        $this->db->select('*');
        $this->db->from('time_leave');
        $where = "Leave_datestart LIKE '$date%' AND Person_id = $Person_id";
        $this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows()>0){
                $data = $query->row();
                return $data;
        }
    }

    public function fetch_product($limit, $start) {
        $this->db->limit($limit, $start);

        $query = $this->db->get("time_leave");

        if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                        $data[] = $row;
                }
                return $data;
        }
        return false;
    }	

    
    //ดึงข้อมูลมาแสดงในตารางที่บี๋ทำให้ จะมีตัวเลขไปนับให้ด้วย
    public function showdata()
    {    
        $docs = $this->listTimeleave();

        $result = array();
        for ($i = 0, $j = 1; $i < count($docs); $i++, $j++) {
                
                $timelogin = new DateTime($docs[$i]['Time_loginm']);
                $timeloginm2 = $timelogin->format('H.i น.');
                $date = $timelogin->format('d/m/y');
                $fulldate = $timelogin->format('Y-m-d');
                if(isset($docs[$i]['Time_logina'])){// ถ้าเวลาลงชื่อช่วงบ่ายเป็นค่าว่างไม่ต้องแสดงออกมา
                        $timelogin = new DateTime($docs[$i]['Time_logina']);
                        $timelogina2 = $timelogin->format('H.i น.');
                }
                else{
                        $timelogina2 = '-';
                }


                if(isset($docs[$i]['Time_logout'])){// ถ้าเวลาลงชื่อออกเป็นค่าว่างไม่ต้องแสดงออกมา
                        $timelogout = new DateTime($docs[$i]['Time_logout']);
                        $timelogout2 = $timelogout->format('H.i น.');
                }
                else{
                        $timelogout2 = '-';
                }
                if(isset($docs[$i]['Time_logout_reason'])){// ถ้ามีงานช่วงเช้า ก็ให้แสดงออกมา
                        $timelogoutareason = $docs[$i]['Time_logout_reason'];
                }
                else{
                        $timelogoutareason = '-';
                }
                if($docs[$i]['Time_mobile_reasonm'] != ''){$Time_mobile_reasonm = ' (m)';}else{$Time_mobile_reasonm = '';}
                if($docs[$i]['Time_mobile_reasona'] != ''){$Time_mobile_reasona = ' (m)';}else{$Time_mobile_reasona = '';}
                if($docs[$i]['Time_mobile_reasonout'] != ''){$Time_mobile_reasono = ' (m)';}else{$Time_mobile_reasono = '';}

                    $doc = array(                    
                        'no' => $j,
                        'Time_id' => $docs[$i]['Time_id'],                        
                        'Date' => $date,                                
                        'Fulldate' => $fulldate,              
                        'Time_loginm' => $timeloginm2.$Time_mobile_reasonm,
                        'Time_logina' => $timelogina2.$Time_mobile_reasona,
                        'Time_logout' => $timelogout2.$Time_mobile_reasono,
                        'Time_logout_reason' => $timelogoutareason,
                    );
            
            array_push($result, $doc);
        }
        return $result;
    }


    // ดึงรายละเอียดวันที่ปัจจุบันเป็นค่ามาตรฐาน
    public function showdetailtoday(){      
        $datetimes = new DateTime(); // เอาวันที่ปัจจุบัน มาแปลง format
        $datetimes = $datetimes->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $date = $datetimes->format('Y-m-d'); // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้        
        if(isset($_SESSION['Person_id'])){$Person_id = $_SESSION['Person_id'];}else{$Person_id='0';}   

        $data = $this->showdetail($date,$Person_id); // ดึงข้อมูลของวันนี้ออกมา
        return $data;
    }    


    // เอาวันที่มาใส่เพื่อดึงรายละเอียด
    public function showdetail($date,$Person_id)
    {   
        $data = $this->readTimeleavedetail($date,$Person_id); // ดึงข้อมูลของวันนี้ออกมา

                $timeround = 'เช้า'; // ตัวแปรที่ระบุว่าจะเอารอบไหนเข้าไปตรวสอบ
                $popup1 = $this->chktimelogin($date,$timeround); // เอาวันที่เข้ามาเทียบว่าวันนี้มีการเช็คชื่อของช่วงเช้าหรือยัง
                if($popup1 == 'เช็คชื่อ'){ // ถ้าได้ค่าตอบกลับมาว่าเช็คชื่อช่วงเช้าแล้ว ให้แจ้ง error ได้ทันที
                        $newtime = new DateTime($data->Time_loginm);
                        $time2 = $newtime->format('H:i').' น.'; // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้
                        $loginm = $time2;
                        $Time_mobile_reasonm = $data->Time_mobile_reasonm;
                        $disabledm = 'disabled'; // ตัวแปรสำหรับทำช่องเช็คชื่อให้เป็น disabled
                }
                else{
                        $loginm = '';
                        $disabledm = '';
                        $Time_mobile_reasonm = '';
                }
        
                $timeround = 'บ่าย'; // ตัวแปรที่ระบุว่าจะเอารอบไหนเข้าไปตรวสอบ
                $popup2 = $this->chktimelogin($date,$timeround); // เอาวันที่เข้ามาเทียบว่าวันนี้มีการเช็คชื่อของช่วงบ่ายหรือยัง
        
                if($popup2 == 'เช็คชื่อ'){ // ถ้าได้ค่าตอบกลับมาว่าเช็คชื่อช่วงเช้าแล้ว ให้แจ้ง error ได้ทันที
                        $time = new DateTime($data->Time_logina);
                        $time2 = $time->format('H:i').' น.'; // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้
                        $logina = $time2;
                        $Time_mobile_reasona = $data->Time_mobile_reasona;
                        $disableda = 'disabled'; // ตัวแปรสำหรับทำช่องเช็คชื่อให้เป็น disabled
                }
                else{
                        $logina = '';
                        $disableda = '';
                        $Time_mobile_reasona = '';
                }
        
                $timeround = 'เย็น'; // ตัวแปรที่ระบุว่าจะเอารอบไหนเข้าไปตรวสอบ
                
                $popup3 = $this->chktimelogin($date,$timeround); // เอาวันที่เข้ามาเทียบว่าวันนี้มีการเช็คชื่อของช่วงเย็นหรือยัง
        
                if($popup3 == 'เช็คชื่อ'){ // ถ้าได้ค่าตอบกลับมาว่าเช็คชื่อช่วงเช้าแล้ว ให้แจ้ง error ได้ทันที
                        $time = new DateTime($data->Time_logout);
                        $time2 = $time->format('H:i').' น.'; // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้
                        $logout = $time2;
                        $logout_reason = $data->Time_logout_reason;
                        $Time_mobile_reasonout = $data->Time_mobile_reasonout;
                        $disabledo = 'disabled'; // ตัวแปรสำหรับทำช่องเช็คชื่อให้เป็น disabled
                }
                else{
                        $logout = '';
                        $logout_reason = '';
                        $disabledo = '';
                        $Time_mobile_reasonout = '';
                }
        
                if($data != ''){ // ถ้าดึงค่าออกมาได้จะแสดงออกมา เป็นวันที่นั้นๆ
                        $datetime = new DateTime($data->Time_loginm);
                        $date = $datetime->format('d/m/y');
                }
                else{ // ถ้าไม่มีค่าเข้ามา แสดงว่าเป็นครั้งแรกของวัน จะแสดงวันที่วันนี้
                        $datetime = new DateTime();
                        $date = $datetime->format('d/m/y');
                }
                $doc = array(                    
                        'Date' => $date,
                        'Loginm' => $loginm,
                        'Logina' => $logina,                        
                        'Time_logout_reason' => $logout_reason,       
                        'Time_mobile_reasonm' => $Time_mobile_reasonm,       
                        'Time_mobile_reasona' => $Time_mobile_reasona,       
                        'Time_mobile_reasonout' => $Time_mobile_reasonout,       
                        'Logout' => $logout,         
                        'Disabledm' => $disabledm,     
                        'Disableda' => $disableda,     
                        'Disabledo' => $disabledo,     
                    );
                return $doc;
        
        

    }
    // ตรวจสอบว่าวันนี้มีการลงชื่อช่วงต่างๆไปหรือยัง
    public function chktimelogin($date,$timeround) 
    {                         
        $qry = $this->listTimeleave();

        for ($i=0 ; $i < count($qry) ; $i++){
                if($timeround == 'เช้า'){ // ถ้ารอบที่เข้ามาเป็นรอบเช้าจะเอารอบเช้าไปวาง
                        $timeround2 = $qry[$i]['Time_loginm'];
                }
                if($timeround == 'บ่าย'){ // ถ้ารอบที่เข้ามาเป็นรอบเช้าจะเอารอบเช้าไปวาง
                        $timeround2 = $qry[$i]['Time_logina'];
                }
                if($timeround == 'เย็น'){ // ถ้ารอบที่เข้ามาเป็นรอบเช้าจะเอารอบเช้าไปวาง
                        $timeround2 = $qry[$i]['Time_logout'];
                }

                $Timefromdb = new DateTime($timeround2); // เอาเวลา จากฐานข้อมูลมาแปลงเอาแต่วันที่
                $Timefromdb2 = $Timefromdb->format('Y-m-d');

                if($Timefromdb2 == $date && $timeround2 != ''){ // ถ้าวันที่ ที่เข้ามามีอยู่แล้วในระบบให้ Error ถ้าไม่มีก็จะสามารถทำต่อได้
                        $popup = "เช็คชื่อ";
                        return $popup;
                }                        
        }
    }    

    /*-------------------------------------------Login-------------------------------------------*/
    /*-------------------------------------------Login-------------------------------------------*/
    /*-------------------------------------------Login-------------------------------------------*/
    // ล็อคอินช่วงเช้า
    public function time_loginm() 
	{                         
                // เอาค่าที่รับมาจากช่อง login มาดูว่า วันนี้มีการเช็คชื่อรอบเช้าไปหรือยัง              
                $Time_login = $this->input->post('Time_login');
                $newTime_login = new DateTime($Time_login); // เอาค่าที่ได้รับมา มาแปลง format
                $date = $newTime_login->format('Y-m-d'); // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้
                $timeround = 'เช้า'; // ตัวแปรที่ระบุว่าจะเอารอบไหนเข้าไปตรวสอบ

                $popup = $this->chktimelogin($date,$timeround); // เอาวันที่เข้ามาเทียบว่าวันนี้มีการเช็คชื่อของช่วงเช้าหรือยัง
                if($popup == 'เช็คชื่อ'){ // ถ้าได้ค่าตอบกลับมาว่าเช็คชื่อช่วงเช้าแล้ว ให้แจ้ง error ได้ทันที
                        $popup2 = $popup.$timeround;
                        return $popup2;
                }

                // ถ้าวันนี้ยังไม่ได้เช็คชื่อ จะอนุญาตให้เพิ่มข้อมูลได้
                $datainsert = array(
                        'Time_loginm' => $Time_login,
                        'Time_mobile_reasonm' => $this->input->post('Time_mobile_reasonm'),
                        'Person_id' => $_SESSION['Person_id']
                );
                //query ข้อมูลเข้าฐานข้อมูล
                $this->db->insert('time_leave',$datainsert);
    }
    // ล็อคอินช่วงบ่าย
    public function time_logina() 
	{
                // เอาค่าที่รับมาจากช่อง login มาดูว่า วันนี้มีการเช็คชื่อรอบเช้าไปหรือยัง              
                $Time_login = $this->input->post('Time_login');  
                
                $newTime_login = new DateTime($Time_login); // เอาค่าที่ได้รับมา มาแปลง format
                $date = $newTime_login->format('Y-m-d'); // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้
                $Person_id = $_SESSION['Person_id'];

                $data = $this->readTimeleavedetail($date,$Person_id); // ดึงข้อมูลของวันนี้ออกมา
                
                $timeround = 'บ่าย'; // ตัวแปรที่ระบุว่าจะเอารอบไหนเข้าไปตรวสอบ
                $popup = $this->chktimelogin($date,$timeround); // เอาวันที่เข้ามาเทียบว่าวันนี้มีการเช็คชื่อของช่วงเช้าหรือยัง
                if($popup == 'เช็คชื่อ'){ // ถ้าได้ค่าตอบกลับมาว่าเช็คชื่อช่วงเช้าแล้ว ให้แจ้ง error ได้ทันที
                        $popup2 = $popup.$timeround;
                        return $popup2;
                }

                // ถ้าวันนี้ยังไม่ได้เช็คชื่อ จะอนุญาตให้เพิ่มข้อมูลได้
                $dataupdate = array(
                        'Time_logina' => $Time_login,
                        'Time_mobile_reasona' => $this->input->post('Time_mobile_reasona'),
                );
                //query ข้อมูลเข้าฐานข้อมูล
                $Time_id = $data->Time_id; // ดึง Time_id ออกมา เพื่อใช้สำหรับ Where
                $this->db->where('Time_id',$Time_id);
                $this->db->update('time_leave',$dataupdate);
    }
    // ล็อคอินช่วงเย็น
    public function time_logout() 
	{
                // เอาค่าที่รับมาจากช่อง login มาดูว่า วันนี้มีการเช็คชื่อรอบเช้าไปหรือยัง              
                $Time_logout = $this->input->post('Time_logout');  
                $Time_logout_reason = $this->input->post('Time_logout_reason');

                $newTime_logout = new DateTime($Time_logout); // เอาค่าที่ได้รับมา มาแปลง format
                $date = $newTime_logout->format('Y-m-d'); // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้
                $Person_id = $_SESSION['Person_id'];

                $data = $this->readTimeleavedetail($date,$Person_id); // ดึงข้อมูลของวันนี้ออกมา

                $timeround = 'เย็น'; // ตัวแปรที่ระบุว่าจะเอารอบไหนเข้าไปตรวสอบ
                
                $popup = $this->chktimelogin($date,$timeround); // เอาวันที่เข้ามาเทียบว่าวันนี้มีการเช็คชื่อของช่วงเย็นหรือยัง
                if($popup == 'เช็คชื่อ'){ // ถ้าได้ค่าตอบกลับมาว่าเช็คชื่อช่วงเช้าแล้ว ให้แจ้ง error ได้ทันที
                        $popup2 = $popup.$timeround;
                        return $popup2;
                }

              
                // ถ้าวันนี้ยังไม่ได้เช็คชื่อ จะอนุญาตให้เพิ่มข้อมูลได้
                $dataupdate = array(
                        'Time_logout' => $Time_logout,
                        'Time_mobile_reasonout' => $this->input->post('Time_mobile_reasonout'),
                        'Time_logout_reason' => $Time_logout_reason
                );
                //query ข้อมูลเข้าฐานข้อมูล
                $Time_id = $data->Time_id; // ดึง Time_id ออกมา เพื่อใช้สำหรับ Where
                $this->db->where('Time_id',$Time_id);
                $this->db->update('time_leave',$dataupdate);
    }


 


}

?>