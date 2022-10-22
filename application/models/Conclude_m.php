<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Conclude_m extends CI_Model {

	/*--------------------------------------แสดงรายชื่อออกมาในตาราง--------------------------------------*/
	/*--------------------------------------แสดงรายชื่อออกมาในตาราง--------------------------------------*/
	/*--------------------------------------แสดงรายชื่อออกมาในตาราง--------------------------------------*/
   
    
	/*--------------------------------------แสดงข้อมูลวันปัจจุบันแบบไม่ต้องรับค่า--------------------------------------*/

    // ดึงรายละเอียดวันที่ปัจจุบันเป็นค่ามาตรฐาน
    public function showconclude($date){      
        $datetimes = new DateTime($date); // เอาวันที่ปัจจุบัน มาแปลง format
        $datetimes = $datetimes->setTimezone(new DateTimeZone('Asia/Bangkok'));
        
        $date = $datetimes->format('Y-m-d'); // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้        

        $this->db->select('*');
        $this->db->from('review,person');
        $this->db->where("person.Person_id = review.Person_id AND Review_date LIKE '$date%'");
        $docs = $this->db->get();
        $data = $docs->result_array();
        return $data;
    }    


	/*--------------------------------------/แสดงข้อมูลวันปัจจุบันแบบไม่ต้องรับค่า--------------------------------------*/

   

    //ดึงข้อมูลมาแสดงในตารางที่บี๋ทำให้ จะมีตัวเลขไปนับให้ด้วย
    public function showdata($docs)
    {
        $result = array();
        for ($i = 0, $j = 1; $i < count($docs); $i++, $j++) {


            if($docs[$i]['Status'] != 'ยืนยันแล้ว' && $docs[$i]['Department'] == $_SESSION['Department']){ // เมื่อสถานะยังไม่ได้รับการยืนยันและเป็นแผนกเดียวกับคนที่ล็อคอินเข้ามาเท่านั้น ถึงจะเห็นปุ่มนี้
                $button = "<a href='".site_url('review?mode=approve&tid=').$docs[$i]['Time_id']."' class='btn btn-success'>".
                "<span class='icon'><i class='fas fa-check-circle'></i> อนุมัติ</span></a>";
            }
            elseif($docs[$i]['Status'] != 'ยืนยันแล้ว' && $docs[$i]['Department'] != $_SESSION['Department']){ // เมื่อสถานะยังไม่ได้รับการยืนยันและไม่ได้เป็นแผนกเดียวกับคนที่ล็อคอินเข้ามาเท่านั้น ถึงจะเห็นปุ่มนี้
                $button = "<button class='btn btn-warning'>".
                "<span class='icon'> ยังไม่อนุมัติ</button>";
            }
            else{              
                $button = "<button class='btn btn-success'>".
                "<span class='icon'> อนุมัติแล้ว</button>";
            }

            $doc = array(
                'no' => $j,
                'Person_id' => $docs[$i]['Person_id'],
                'Person_name' => $docs[$i]['Person_name'],
                'Person_sname' => $docs[$i]['Person_sname'],
                'Person_niname' => $docs[$i]['Person_niname'],
                'Position' => $docs[$i]['Position'],
                'Button' => $button,
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