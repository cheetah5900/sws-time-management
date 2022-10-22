<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Check_m extends CI_Model {

    /*-------------------------------------------FETCH DATA-------------------------------------------*/
    /*-------------------------------------------FETCH DATA-------------------------------------------*/
    /*-------------------------------------------FETCH DATA-------------------------------------------*/

    // รายชื่อบริษัท
    public function listTimecheck() {
        if(isset($_SESSION['Person_id'])){$Person_id = $_SESSION['Person_id'];}else{$Person_id='0';}     
        $this->db->select('*');
        $this->db->from('time_check,person');
        $where = "time_check.Person_id = person.Person_id AND time_check.Person_id = '$Person_id' ORDER BY Time_id DESC";
        $this->db->where($where);
        // คำสั่ง limit
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 5;
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query->result_array();
    }
    public function listTimecheck_count(){
        if(isset($_SESSION['Person_id'])){$Person_id = $_SESSION['Person_id'];}else{$Person_id='0';}     
        $this->db->select('*');
        $this->db->from('time_check,person');
        $where = "time_check.Person_id = person.Person_id AND time_check.Person_id = $Person_id";
        $this->db->where($where);
        $query =$this->db->get();
        return $query->num_rows();
    }
    //ดึงข้อมูล Time ตาม Time_id ที่ได้รับเข้ามา เพื่อเอาไปแสดงในหน้า Time_detail
    public function readTimecheckdetail($date,$Person_id)
    {
        $this->db->select('*');
        $this->db->from('time_check');
        $where = "Time_loginm LIKE '$date%' AND Person_id = $Person_id";
        $this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows()>0){
                $data = $query->row();
                return $data;
        }
    }
    public function readProblemid($Problem_id)
    {
        $this->db->select('*');
        $this->db->from('problem');
        $where = "Problem_id = $Problem_id";
        $this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows()>0){
                $data = $query->row();
                return $data;
        }
    }

    public function fetch_product($limit, $start) {
        $this->db->limit($limit, $start);

        $query = $this->db->get("time_check");

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
        $docs = $this->listTimecheck();

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



    // เอาวันที่มาใส่เพื่อดึงรายละเอียด
    public function showdetail($date,$Person_id)
    {    
        // echo $date;
        // echo '<br>';
        // echo $Person_id;
        // exit;
                $data = $this->readTimecheckdetail($date,$Person_id);  // เอาข้อมูลของการเช็คชื่อดังกล่าวออกมา

                // echo "<pre>";
                // print_r($data);
                // echo "</pre>";
                // exit;
                $timeround = 'เช้า'; // ตัวแปรที่ระบุว่าจะเอารอบไหนเข้าไปตรวสอบ
                $popup1 = $this->chktimelogin($date,$timeround); // เอาวันที่เข้ามาเทียบว่าวันนี้มีการเช็คชื่อของช่วงเช้าหรือยัง
                if($popup1 == 'เช็คชื่อ'){ // ถ้าได้ค่าตอบกลับมาว่าเช็คชื่อช่วงเช้าแล้ว ให้แจ้ง error ได้ทันที
                        $newtime = new DateTime($data->Time_loginm);
                        $time2 = $newtime->format('H:i').' น.'; // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้
                        $loginm = $time2; // เวลาที่เช็คไปตอนเช้า

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

                /* 
                *  ตรวจสอบว่ามีปัญหางานหรือไม่ ถ้ามีก็จะดึงวันที่ออกมาแล้วไปแสดงในหน้าเช็คชื่อ แต่ถ้าไม่มีก็จะให้เป็นค่าว่างแทน 
                */
                
                //? ตรวจสอบว่ามีค่าออกมาหรือไม่ ถ้ามีก็จะแทนค่า แต่ถ้าไม่มีจะให้เป็นค่าว่างเพื่อไม่ให้ระบบ Error
                if(isset($data->Problem_id1) && $data->Problem_id1 != 0){
                        $Problem_id = $data->Problem_id1;
                        $qryprmid = $this->readProblemid($Problem_id); // ดึงข้อมูลรายละเอียปัญหาออกมา
                        $Problem_detail1 = $qryprmid->Problem_detail;
                        $Person_follow1 = $qryprmid->Person_follow;

                        $date_follow = new DateTime($qryprmid->Date_follow);
                        $Date_follow1 = $date_follow->format('Y-m-d');
                        $Time_follow1 = $date_follow->format('H:i');
                }
                else{
                        $Problem_detail1 = '';
                        $Person_follow1 = '';
                        $Date_follow1 = '';
                        $Time_follow1 = '';
                }
                if(isset($data->Problem_id2) && $data->Problem_id2 != 0){
                        $Problem_id = $data->Problem_id2;
                        $qryprmid = $this->readProblemid($Problem_id); // ดึงข้อมูลรายละเอียปัญหาออกมา
                        $Problem_detail2 = $qryprmid->Problem_detail;
                        $Person_follow2 = $qryprmid->Person_follow;

                        $date_follow = new DateTime($qryprmid->Date_follow);
                        $Date_follow2 = $date_follow->format('Y-m-d');
                        $Time_follow2 = $date_follow->format('H:i');
                }
                else{
                        $Problem_detail2 = '';
                        $Person_follow2 = '';
                        $Date_follow2 = '';
                        $Time_follow2 = '';
                }
                if(isset($data->Problem_id3) && $data->Problem_id3 != 0){
                        $Problem_id = $data->Problem_id3;
                        $qryprmid = $this->readProblemid($Problem_id); // ดึงข้อมูลรายละเอียปัญหาออกมา
                        $Problem_detail3 = $qryprmid->Problem_detail;
                        $Person_follow3 = $qryprmid->Person_follow;

                        $date_follow = new DateTime($qryprmid->Date_follow);
                        $Date_follow3 = $date_follow->format('Y-m-d');
                        $Time_follow3 = $date_follow->format('H:i');
                }
                else{
                        $Problem_detail3 = '';
                        $Person_follow3 = '';
                        $Date_follow3 = '';
                        $Time_follow3 = '';
                }

                if(isset($data->Time_id)){$Time_id = $data->Time_id;}else{$Time_id='';}
                
                $doc = array(              
                        'Time_id' => $Time_id,
                        'Date' => $date,
                        'Loginm' => $loginm,
                        'Logina' => $logina,                        
                        'Time_logout_reason' => $logout_reason,       
                        'Time_mobile_reasonm' => $Time_mobile_reasonm,       
                        'Time_mobile_reasona' => $Time_mobile_reasona,       
                        'Time_mobile_reasonout' => $Time_mobile_reasonout,     
                        'Problem_detail1' => $Problem_detail1,       
                        'Problem_detail2' => $Problem_detail2,
                        'Problem_detail3' => $Problem_detail3,       
                        'Person_follow1' => $Person_follow1,        
                        'Person_follow2' => $Person_follow2,       
                        'Person_follow3' => $Person_follow3,        
                        'Date_follow1' => $Date_follow1,       
                        'Date_follow2' => $Date_follow2,       
                        'Date_follow3' => $Date_follow3,       
                        'Time_follow1' => $Time_follow1,       
                        'Time_follow2' => $Time_follow2,       
                        'Time_follow3' => $Time_follow3,       
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
        if(isset($_SESSION['Person_id'])){$Person_id = $_SESSION['Person_id'];}else{$Person_id='0';}         
        $qry = $this->readTimecheckdetail($date,$Person_id);    
        if($qry != ''){ // ถ้ามันออกมาเป็นค่าว่างแสดงว่ายังไม่ได้ล็อกอิน
                if($timeround == 'เช้า'){ // ถ้ารอบที่เข้ามาเป็นรอบเช้าจะเอารอบเช้าไปวาง
                        $timeround2 = $qry->Time_loginm;
                }
                if($timeround == 'บ่าย'){ // ถ้ารอบที่เข้ามาเป็นรอบเช้าจะเอารอบเช้าไปวาง
                        $timeround2 = $qry->Time_logina;
                }
                if($timeround == 'เย็น'){ // ถ้ารอบที่เข้ามาเป็นรอบเช้าจะเอารอบเช้าไปวาง
                        $timeround2 = $qry->Time_logout;
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

                //TODO ถ้ามีปัญหาเข้ามาจะทำการอัพเดทสร้าง record ปัญหาในตาราง problem แต่ถ้าไม่มีจะข้ามไป
                $Problem_check = $this->input->post('Problem_check');
                if($Problem_check == 'มี'){
                        //? อัพเดทปัญหาเข้าตารางปัญหา
                        $dataproblem = array(
                                'Problem_detail' => $this->input->post('Problem_detail'),
                                'Person_follow' => $this->input->post('Person_follow'),
                                'Date_follow' => $this->input->post('Date_follow')." ".$this->input->post('Time_follow').":00",
                        );

                        //query ข้อมูลเข้าฐานข้อมูล
                        $this->db->insert('problem',$dataproblem);

                        //? ดึง Problem_id ตัวล่าสุดออกมาเพื่อเอาไปอัพเดทให้ตารางเช็คชื่อ
                        $qry = $this->db->query("SELECT Problem_id FROM problem ORDER BY Problem_id DESC LIMIT 1");
                        $row = $qry->row();
                        $pulllastpid = $row->Problem_id;
                }
                        //? ถ้าวันนี้ยังไม่ได้เช็คชื่อ จะอนุญาตให้เพิ่มข้อมูลได้
                        $datainsert = array(
                                'Time_loginm' => $Time_login,
                                'Time_mobile_reasonm' => $this->input->post('Time_mobile_reasonm'),
                                'Person_id' => $_SESSION['Person_id']
                        );
                        //query ข้อมูลเข้าฐานข้อมูล
                        $this->db->insert('time_check',$datainsert);

                //TODO ถ้ามีปัญหาเข้ามาจะทำการอัพเดทสร้าง record ปัญหาในตาราง problem แต่ถ้าไม่มีจะข้ามไป
                if($Problem_check == 'มี'){
                        //? อัพเดท Problem_id ให้กับตาราง time_check
                        $dataupdate = array('Problem_id1' => $pulllastpid);
                                
                        //? ดึง Time_id ตัวล่าสุดออกมาเพื่อเอาไปเทียบว่าต้องไปอัพเดทที่ไหน
                        $qry = $this->db->query("SELECT Time_id FROM time_check ORDER BY Time_id DESC LIMIT 1");
                        $row = $qry->row();
                        $pulllasttid = $row->Time_id;
                        
                        //update ข้อมูลในฐานข้อมูล
                        $this->db->where('Time_id',$pulllasttid);
                        $this->db->update('time_check',$dataupdate);
                }

    }
    // ล็อคอินช่วงบ่าย
    public function time_logina() 
	{
                // เอาค่าที่รับมาจากช่อง login มาดูว่า วันนี้มีการเช็คชื่อรอบเช้าไปหรือยัง              
                $Time_login = $this->input->post('Time_login');  
                
                $newTime_login = new DateTime($Time_login); // เอาค่าที่ได้รับมา มาแปลง format
                $date = $newTime_login->format('Y-m-d'); // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้
                $Person_id = $_SESSION['Person_id'];

                $data = $this->readTimecheckdetail($date,$Person_id); // ดึงข้อมูลของวันนี้ออกมา
                if(!isset ($data->Time_id)){ // ถ้าตัวแปร Time_id ไม่มีแสดงว่ามัน fetch ออกมาไม่ได้ให้บอกว่ายังไม่ได้เช็คชื่อช่วงก่อนหน้า
                        $popup = 'ยังไม่ได้เช็คก่อนหน้า';
                        return $popup;
                }
                else{
                        $timeround = 'บ่าย'; // ตัวแปรที่ระบุว่าจะเอารอบไหนเข้าไปตรวสอบ
                        $popup = $this->chktimelogin($date,$timeround); // เอาวันที่เข้ามาเทียบว่าวันนี้มีการเช็คชื่อของช่วงเช้าหรือยัง
                        if($popup == 'เช็คชื่อ'){ // ถ้าได้ค่าตอบกลับมาว่าเช็คชื่อช่วงเช้าแล้ว ให้แจ้ง error ได้ทันที
                                $popup2 = $popup.$timeround;
                                return $popup2;
                        }        
                       
                //TODO ถ้ามีปัญหาเข้ามาจะทำการอัพเดทสร้าง record ปัญหาในตาราง problem แต่ถ้าไม่มีจะข้ามไป
                $Problem_check = $this->input->post('Problem_check');
                if($Problem_check == 'มี'){
                        //? อัพเดทปัญหาเข้าตารางปัญหา
                        $dataproblem = array(
                                'Problem_detail' => $this->input->post('Problem_detail'),
                                'Person_follow' => $this->input->post('Person_follow'),
                                'Date_follow' => $this->input->post('Date_follow')." ".$this->input->post('Time_follow').":00",
                        );

                        //query ข้อมูลเข้าฐานข้อมูล
                        $this->db->insert('problem',$dataproblem);

                        //? ดึง Problem_id ตัวล่าสุดออกมาเพื่อเอาไปอัพเดทให้ตารางเช็คชื่อ
                        $qry = $this->db->query("SELECT Problem_id FROM problem ORDER BY Problem_id DESC LIMIT 1");
                        $row = $qry->row();
                        $pulllastpid = $row->Problem_id;

                        //? อัพเดท Problem_id ให้กับตาราง time_check
                        $dataupdate = array(
                                'Time_logina' => $Time_login,
                                'Time_mobile_reasona' => $this->input->post('Time_mobile_reasona'),
                                'Person_id' => $_SESSION['Person_id'],
                                'Problem_id2' => $pulllastpid
                        );      
                }
                else{
                        //? อัพเดทข้อมูลให้กับตาราง time_check โดยไม่ใช้ Problem_id
                        $dataupdate = array(
                                'Time_logina' => $Time_login,
                                'Time_mobile_reasona' => $this->input->post('Time_mobile_reasona'),
                                'Person_id' => $_SESSION['Person_id']
                        );   
                }                         
                        //? เอาตัวแปร Time_id ที่ส่งมาจากหน้า check (view) เพื่อให้รู้ว่าต้องการอัพเดทค่าไหน
                        $Time_id = $this->input->post('Time_id');

                        //update ข้อมูลในฐานข้อมูล
                        $this->db->where('Time_id',$Time_id);
                        $this->db->update('time_check',$dataupdate);

                }
    }
    // ล็อคอินช่วงเย็น
    public function time_logout() 
	{
                // เอาค่าที่รับมาจากช่อง login มาดูว่า วันนี้มีการเช็คชื่อรอบเช้าไปหรือยัง              
                $Time_logout = $this->input->post('Time_logout');  

                $newTime_logout = new DateTime($Time_logout); // เอาค่าที่ได้รับมา มาแปลง format
                $date = $newTime_logout->format('Y-m-d'); // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้
                $Person_id = $_SESSION['Person_id'];

                $data = $this->readTimecheckdetail($date,$Person_id); // ดึงข้อมูลของวันนี้ออกมา

                if(!isset ($data->Time_id)){ // ถ้าตัวแปร Time_id ไม่มีแสดงว่ามัน fetch ออกมาไม่ได้ให้บอกว่ายังไม่ได้เช็คชื่อช่วงก่อนหน้า
                        $popup = 'ยังไม่ได้เช็คก่อนหน้า';
                        return $popup;
                }
                else{
                        $timeround = 'เย็น'; // ตัวแปรที่ระบุว่าจะเอารอบไหนเข้าไปตรวสอบ
                        
                        $popup = $this->chktimelogin($date,$timeround); // เอาวันที่เข้ามาเทียบว่าวันนี้มีการเช็คชื่อของช่วงเย็นหรือยัง
                        if($popup == 'เช็คชื่อ'){ // ถ้าได้ค่าตอบกลับมาว่าเช็คชื่อช่วงเช้าแล้ว ให้แจ้ง error ได้ทันที
                                $popup2 = $popup.$timeround;
                                return $popup2;
                        }

                //TODO ถ้ามีปัญหาเข้ามาจะทำการอัพเดทสร้าง record ปัญหาในตาราง problem แต่ถ้าไม่มีจะข้ามไป
                $Problem_check = $this->input->post('Problem_check');
                if($Problem_check == 'มี'){
                        //? อัพเดทปัญหาเข้าตารางปัญหา
                        $dataproblem = array(
                                'Problem_detail' => $this->input->post('Problem_detail'),
                                'Person_follow' => $this->input->post('Person_follow'),
                                'Date_follow' => $this->input->post('Date_follow')." ".$this->input->post('Time_follow').":00",
                        );

                        //query ข้อมูลเข้าฐานข้อมูล
                        $this->db->insert('problem',$dataproblem);

                        //? ดึง Problem_id ตัวล่าสุดออกมาเพื่อเอาไปอัพเดทให้ตารางเช็คชื่อ
                        $qry = $this->db->query("SELECT Problem_id FROM problem ORDER BY Problem_id DESC LIMIT 1");
                        $row = $qry->row();
                        $pulllastpid = $row->Problem_id;
                
                        //? อัพเดท Problem_id ให้กับตาราง time_check
                        $dataupdate = array(
                                'Time_logout' => $Time_logout,                                
                                'Time_logout_reason' => $this->input->post('Time_logout_reason'),
                                'Time_mobile_reasonout' => $this->input->post('Time_mobile_reasonout'),
                                'Person_id' => $_SESSION['Person_id'],
                                'Problem_id3' => $pulllastpid
                        );                  
                }
                else{
                        //? อัพเดทข้อมูลให้กับตาราง time_check โดยไม่ใช้ Problem_id
                        $dataupdate = array(
                                'Time_logout' => $Time_logout,                                
                                'Time_logout_reason' => $this->input->post('Time_logout_reason'),
                                'Time_mobile_reasonout' => $this->input->post('Time_mobile_reasonout'),
                                'Person_id' => $_SESSION['Person_id']
                        );       
                }
                        //? เอาตัวแปร Time_id ที่ส่งมาจากหน้า check (view) เพื่อให้รู้ว่าต้องการอัพเดทค่าไหน
                        $Time_id = $this->input->post('Time_id');

                        //? update ข้อมูลในฐานข้อมูล
                        $this->db->where('Time_id',$Time_id);
                        $this->db->update('time_check',$dataupdate);
                }
    }


 


}

?>