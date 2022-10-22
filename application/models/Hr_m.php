<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Hr_m extends CI_Model {
	/*--------------------------------------ดึงข้อมูล--------------------------------------*/
	/*--------------------------------------ดึงข้อมูล--------------------------------------*/
	/*--------------------------------------ดึงข้อมูล--------------------------------------*/
    //รายชื่อดึงข้อมูลคนและผลการทำงานแต่ละวันออกมา โดยจะกรองตามแผนก และ ไม่รวมหัวหน้าทีมเข้าไป
    public function listpersontotimecheck($date) {
        $this->db->select('*');
        $this->db->from('person,time_check');
        $this->db->where("person.Person_id = time_check.Person_id AND Person_status ='Active' AND Time_loginm LIKE '%-$date-%' AND person.Level <> 'Boss' AND person.Level <> 'Root'");
        // คำสั่ง limit
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 10;
        $this->db->limit($limit, $start);
        $docs = $this->db->get();
        return $docs->result_array();
    }    
    
    public function listpersontotimecheck_count($date) {
        $this->db->select('*');
        $this->db->from('person,time_check');
        $this->db->where("person.Person_id = time_check.Person_id AND Person_status ='Active' AND Time_loginm LIKE '%-$date-%' AND person.Level <> 'Boss' AND person.Level <> 'Root'");
        $query = $this->db->get();
        return $query->num_rows();
    }    
	/*--------------------------------------/ดึงข้อมูล--------------------------------------*/
	/*--------------------------------------/ดึงข้อมูล--------------------------------------*/
	/*--------------------------------------/ดึงข้อมูล--------------------------------------*/


	/*--------------------------------------แสดงรายชื่อออกมาในตาราง--------------------------------------*/
	/*--------------------------------------แสดงรายชื่อออกมาในตาราง--------------------------------------*/
	/*--------------------------------------แสดงรายชื่อออกมาในตาราง--------------------------------------*/
   
    
    // แสดงค่าลงในตารางตามประเภทที่ระบุของวันที่ระบุ
    public function showtime_check($date){      
        
        $docs = $this->listpersontotimecheck($date); // ดึงข้อมูลงานของพนักงานแต่ละคนในวันนี้ออกมา
        $data = $this->showdata($docs); // เอาข้อมูลที่ได้มาไปแสดงใน showdata

        return $data;        
    }    


    //ดึงข้อมูลมาแสดงในตารางที่บี๋ทำให้ จะมีตัวเลขไปนับให้ด้วย
    public function showdata($docs)
    {
        $result = array();
        for ($i = 0, $j = 1; $i < count($docs); $i++, $j++) {
            if($docs[$i]['Time_loginm'] != ''){
                $redate = new DateTime($docs[$i]['Time_loginm']); 
                $Time_loginm = $redate->format('H:i น.'); 
                $Date = $redate->format('d'); 
            }
            else{
                $Time_loginm = "-";
            }
            if($docs[$i]['Time_logina'] != ''){$redate = new DateTime($docs[$i]['Time_logina']); $redate2 = $redate->format('H:i น.'); $Time_logina = $redate2;}else{$Time_logina = "-";}
            if($docs[$i]['Time_logout'] != ''){$redate = new DateTime($docs[$i]['Time_logout']); $redate2 = $redate->format('H:i น.'); $Time_logout = $redate2;}else{$Time_logout = "-";}
            if($docs[$i]['Time_logout_reason'] != ''){$Time_logout_reason = $docs[$i]['Time_logout_reason'];}else{$Time_logout_reason = "-";}

       
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
                'Date' => $Date,
                'Time_loginm' => $Time_loginm.$Time_mobile_reasonm,
                'Time_logina' => $Time_logina.$Time_mobile_reasona,
                'Time_logout' => $Time_logout.$Time_mobile_reasono,
                'Time_logout_reason' => $Time_logout_reason,
            );
            array_push($result, $doc);
        }
        return $result;
    }

	/*--------------------------------------/แสดงรายชื่อออกมาในตาราง--------------------------------------*/
	/*--------------------------------------/แสดงรายชื่อออกมาในตาราง--------------------------------------*/
	/*--------------------------------------/แสดงรายชื่อออกมาในตาราง--------------------------------------*/




}

?>