<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Review_m extends CI_Model {
	/*--------------------------------------ดึงข้อมูล--------------------------------------*/
	/*--------------------------------------ดึงข้อมูล--------------------------------------*/
	/*--------------------------------------ดึงข้อมูล--------------------------------------*/
    //รายชื่อดึงข้อมูลคนและผลการทำงานแต่ละวันออกมา โดยจะกรองตามแผนก และ ไม่รวมหัวหน้าทีมเข้าไป
    public function listpersontotimecheck($date,$persondepart) {
        $this->db->select('*');
        $this->db->from('person,time_check');
        $this->db->where("person.Person_id = time_check.Person_id AND Person_status ='Active' AND Time_loginm LIKE '$date%' AND person.Department = '$persondepart' AND person.Level <> 'Boss'");
        $docs = $this->db->get();
        return $docs->result_array();
    }    
    
    public function listpersontotimecheck_count($date,$persondepart) {
        $this->db->select('*');
        $this->db->from('person,time_check');
        $this->db->where("person.Person_id = time_check.Person_id AND Person_status ='Active' AND Time_loginm LIKE '$date%' AND person.Department = '$persondepart' AND person.Level <> 'Boss'");
        $query = $this->db->get();
        return $query->num_rows();
    }    
   // ดึงข้อมูลสรุปของวันนั้นๆออกมา
    public function readconclude($date,$Department)
	{
        $this->db->select('*');
        $this->db->from('person,review');
        $this->db->where("person.Person_id = review.Person_id AND Review_date LIKE '$date%' AND person.Department = '$Department'");
        $query = $this->db->get();
                $data = $query->row();
        return $data;
	}
    // ดึงข้อมูลไฟล์ของ Disburse_round ออกมาในรูปแบบ array
    public function GetfilePerson($Person_id)
    {
            $this->db->select('*');
            $this->db->from('person');
            $where = "Person_id = $Person_id";
            $this->db->where($where);
            $query = $this->db->get();
            if($query->num_rows()>0){
                    $data = $query->result_array();
                    return $data;
            }
    }
	/*--------------------------------------/ดึงข้อมูล--------------------------------------*/
	/*--------------------------------------/ดึงข้อมูล--------------------------------------*/
	/*--------------------------------------/ดึงข้อมูล--------------------------------------*/


	/*--------------------------------------แสดงรายชื่อออกมาในตาราง--------------------------------------*/
	/*--------------------------------------แสดงรายชื่อออกมาในตาราง--------------------------------------*/
	/*--------------------------------------แสดงรายชื่อออกมาในตาราง--------------------------------------*/
   
    
        // ดึงรายละเอียดวันที่ปัจจุบันเป็นค่ามาตรฐาน
        public function showconclude($date,$Department){      
            $datetimes = new DateTime($date); // เอาวันที่ปัจจุบัน มาแปลง format
            $datetimes = $datetimes->setTimezone(new DateTimeZone('Asia/Bangkok'));            
            $date = $datetimes->format('Y-m-d'); // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้        
            
            $data = $this->readconclude($date,$Department); // ดึงข้อมูลสรุปของวันนี้ออกมา
    
            if($data != ''){
                $result = $data;
            }
            else{
                $result = '';
            }
            return $result;
        }    

    // แสดงค่าลงในตารางตามประเภทที่ระบุของวันที่ระบุ
    public function showtime_check($date,$Department){      
        
        $docs = $this->listpersontotimecheck($date,$Department); // ดึงข้อมูลงานของพนักงานแต่ละคนในวันนี้ออกมา
        $data = $this->showdata($docs); // เอาข้อมูลที่ได้มาไปแสดงใน showdata

        return $data;        
    }    


    //ดึงข้อมูลมาแสดงในตารางที่บี๋ทำให้ จะมีตัวเลขไปนับให้ด้วย
    public function showdata($docs)
    {
        $result = array();
        for ($i = 0, $j = 1; $i < count($docs); $i++, $j++) {
            if($docs[$i]['Time_loginm'] != ''){$redate = new DateTime($docs[$i]['Time_loginm']); $redate2 = $redate->format('H:i น.'); $Time_loginm = $redate2;}else{$Time_loginm = "-";}
            if($docs[$i]['Time_logina'] != ''){$redate = new DateTime($docs[$i]['Time_logina']); $redate2 = $redate->format('H:i น.'); $Time_logina = $redate2;}else{$Time_logina = "-";}
            if($docs[$i]['Time_logout'] != ''){$redate = new DateTime($docs[$i]['Time_logout']); $redate2 = $redate->format('H:i น.'); $Time_logout = $redate2;}else{$Time_logout = "-";}
            if($docs[$i]['Time_logout_reason'] != ''){$Time_logout_reason = $docs[$i]['Time_logout_reason'];}else{$Time_logout_reason = "-";}

            if($docs[$i]['Status'] != 'ยืนยันแล้ว' && $docs[$i]['Department'] == $_SESSION['Department']){ // เมื่อสถานะยังไม่ได้รับการยืนยันและเป็นแผนกเดียวกับคนที่ล็อคอินเข้ามาเท่านั้น ถึงจะเห็นปุ่มนี้
                $button = "<a href='".site_url('review?mode=approve&tid=').$docs[$i]['Time_id']."' class='btn btn-primary'>".
                "<span class='icon'><i class='fas fa-check-circle'></i> อนุมัติ</span></a>";
            }
            elseif($docs[$i]['Status'] != 'ยืนยันแล้ว' && $docs[$i]['Department'] != $_SESSION['Department']){ // เมื่อสถานะยังไม่ได้รับการยืนยันและไม่ได้เป็นแผนกเดียวกับคนที่ล็อคอินเข้ามาเท่านั้น ถึงจะเห็นปุ่มนี้
                $button = "<button class='btn btn-warning'>".
                "<span class='icon'><i class='fas fa-check-circle'></i> ยังไม่อนุมัติ</span> </button>";
            }
            else{              
                $button = "<button class='btn btn-success'>".
                "<span class='icon'><i class='fas fa-check-circle'></i> อนุมัติแล้ว</span> </button>";
            }

            if($docs[$i]['Time_mobile_reasonm'] != ''){$Time_mobile_reasonm = ' (m)';}else{$Time_mobile_reasonm = '';}
            if($docs[$i]['Time_mobile_reasona'] != ''){$Time_mobile_reasona = ' (m)';}else{$Time_mobile_reasona = '';}
            if($docs[$i]['Time_mobile_reasonout'] != ''){$Time_mobile_reasono = ' (m)';}else{$Time_mobile_reasono = '';}

            $doc = array(
                'no' => $j,
                'Person_id' => $docs[$i]['Person_id'],
                'Person_name' => $docs[$i]['Person_name'],
                'Person_sname' => $docs[$i]['Person_sname'],
                'Person_niname' => $docs[$i]['Person_niname'],
                'Position' => $docs[$i]['Position'],
                'Time_id' => $docs[$i]['Time_id'],
                'Time_loginm' => $Time_loginm.$Time_mobile_reasonm,
                'Time_logina' => $Time_logina.$Time_mobile_reasona,
                'Time_logout' => $Time_logout.$Time_mobile_reasono,
                'Time_logout_reason' => $Time_logout_reason,
                'Status' => $docs[$i]['Status'],
                'Button' => $button,
            );
            array_push($result, $doc);
        }
        return $result;
    }

	/*--------------------------------------/แสดงรายชื่อออกมาในตาราง--------------------------------------*/
	/*--------------------------------------/แสดงรายชื่อออกมาในตาราง--------------------------------------*/
	/*--------------------------------------/แสดงรายชื่อออกมาในตาราง--------------------------------------*/






	/*--------------------------------------เปลี่ยนแปลงและแก้ไขข้อมูล--------------------------------------*/
	/*--------------------------------------เปลี่ยนแปลงและแก้ไขข้อมูล--------------------------------------*/
	/*--------------------------------------เปลี่ยนแปลงและแก้ไขข้อมูล--------------------------------------*/    
    
    //เพิ่มข้อมูลเข้าสู่ฐานข้อมูล
    public function add_review()
	{
        $datetimes = new DateTime(); // เอาวันที่ปัจจุบัน มาแปลง format
        $datetimes = $datetimes->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $date = $datetimes->format('Y-m-d H:i:s');

            $datainsert = array(        
            'Review_detail' => $this->input->post('Review_detail'),
            'Department' => $this->input->post('Department'),
            'Person_id' => $_SESSION['Person_id'],
            'Review_date' => $date
            );

            //query ข้อมูลเข้าฐานข้อมูล
            $this->db->insert('review',$datainsert);               
        
	}

    // ดึงสถานะออกมาแล้วแก้ไขเพื่อยืนยันงานดังกล่าว
    public function work_approve($Time_id)
    {
        $dataupdate = array('Status' => 'ยืนยันแล้ว');
        $this->db->where('Time_id',$Time_id);
        $this->db->update('time_check',$dataupdate);
    }
    /*--------------------------------------/เปลี่ยนแปลงและแก้ไขข้อมูล--------------------------------------*/
	/*--------------------------------------/เปลี่ยนแปลงและแก้ไขข้อมูล--------------------------------------*/
	/*--------------------------------------/เปลี่ยนแปลงและแก้ไขข้อมูล--------------------------------------*/





}

?>