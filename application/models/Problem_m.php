<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Problem_m extends CI_Model {

    /*-------------------------------------------FETCH DATA-------------------------------------------*/
    /*-------------------------------------------FETCH DATA-------------------------------------------*/
    /*-------------------------------------------FETCH DATA-------------------------------------------*/

    // ? รายการแบบไม่ limit
    public function listproblem() {
        if(isset($_SESSION['Person_id'])){$Person_id = $_SESSION['Person_id'];}else{$Person_id='0';}     
        $this->db->select('*');
        $this->db->from('time_check,person,problem');
        $where = "time_check.Person_id = person.Person_id AND time_check.Person_id = '$Person_id' AND (problem.Problem_id = time_check.Problem_id1 OR problem.Problem_id = time_check.Problem_id2 OR problem.Problem_id = time_check.Problem_id3)";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function readProblem($Problem_id) {
        $this->db->select('*');
        $this->db->from('problem');
        $where = "problem.Problem_id = $Problem_id";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    // ? สำหรับอัพเดทข้อมูลแก้ปัญหา
    public function fixproblem() 
	{                                
            $Problem_result = $this->input->post('Problem_result');       
            $Problem_id = $this->input->post('Problem_id');
            
            // ? ถ้ารอบมาเป็นรอบไหนจะไปอัพเดทอันนั้น
            $dataupdate = array('Problem_result' => $Problem_result);
            
            //? query ข้อมูลเข้าฐานข้อมูล
            $this->db->where('Problem_id',$Problem_id);
            $this->db->update('problem',$dataupdate);
    }

    // ? สำหรับอัพเดทค่าเลื่อนเวลา
    public function postpone() 
	{                                  
            $Problem_id = $this->input->post('Problem_id');
            $Date_follow = $this->input->post('Date_follow');       
            $Time_follow = $this->input->post('Time_follow');
            $Datetime_follow = $Date_follow." ".$Time_follow;
            
            // ? ถ้ารอบมาเป็นรอบไหนจะไปอัพเดทอันนั้น
            $dataupdate = array('Date_follow' => $Datetime_follow);
            
            //? query ข้อมูลเข้าฐานข้อมูล
            $this->db->where('Problem_id',$Problem_id);
            $this->db->update('problem',$dataupdate);
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
    
    // ! ลิสต์รายการที่ถึงกำหนด ที่ยังไม่ถึง และที่แก้แล้ว
    public function showdatareach()
    {    
        $docs = $this->listproblem();
        // ? ดึงวันและเวลาปัจจุบันออกมาเพื่อเทียบกับเวลาของปัญหาต่างๆ
        date_default_timezone_set("Asia/Bangkok");
        $dateformat = new DateTime();
        $datenow = $dateformat->format('Y-m-d'); // สำหรับดึงข้อมูลวันนี้ออกมา
        $timenow = $dateformat->format('H:i'); // สำหรับดึงข้อมูลเวลาปัจจุบันของวันนี้ออกมา

        $resultreach = array();
        $resultgoing = array();
        $resultdone = array();
        for ($i = 0; $i < count($docs); $i++) {
            
                // TODO ตรวจสอบว่าเวลาที่เข้ามามีปัญหาหรือไม่ ถ้ามีจะแสดงและ array_push แต่ถ้าไม่มีจะไม่ทำอะไรเลย

                        // ? แปลง Timestamp ให้กลายเป็นเวลาปกติ
                        if($docs[$i]['Problem_id'] == $docs[$i]['Problem_id1']){ // ถ้าปัญหาในตาราง problem เป็นของช่วงเช้า รหัสจะตรงกัน แล้วจะใช้ข้อมูลของช่วงเช้าดำเนินการต่อ
                            $dateformat = new DateTime($docs[$i]['Time_loginm']);
                        }
                            if($docs[$i]['Problem_id'] == $docs[$i]['Problem_id2']){ // ถ้าปัญหาในตาราง problem เป็นของช่วงบ่าย รหัสจะตรงกัน แล้วจะใช้ข้อมูลของช่วงเช้าดำเนินการต่อ
                            $dateformat = new DateTime($docs[$i]['Time_logina']);
                        }
                            if($docs[$i]['Problem_id'] == $docs[$i]['Problem_id3']){ // ถ้าปัญหาในตาราง problem เป็นของช่วงเย็น รหัสจะตรงกัน แล้วจะใช้ข้อมูลของช่วงเช้าดำเนินการต่อ
                            $dateformat = new DateTime($docs[$i]['Time_logout']);
                        }
                        $timefound = $dateformat->format('H.i น.'); 
                        $datefound = $dateformat->format('d/m/y');

                        // ? แปลง Timestamp ให้กลายเป็นวันและเวลา
                        $dateformat = new DateTime($docs[$i]['Date_follow']);
                        $timeproblem = $dateformat->format('H.i น.'); // แปลง Timestamp ให้กลายเป็นเวลาปกติ
                        $dateproblem = $dateformat->format('d/m/y');
                        $datecheck = $dateformat->format('Y-m-d'); // สำหรับดึงข้อมูลวันของปัญหา เพื่อตรวจสอบว่าวันของปัญหานี้ตรงกับ ณ วันนี้หรือเปล่า
                        $timecheck = $dateformat->format('H:i'); // สำหรับดึงข้อมูลเวลาของปัญหา เพื่อตรวจสอบว่าเวลาของปัญหานี้ตรงกับ ณ วันนี้ เวลาเดียวกันหรือเปล่า
                        

                if($docs[$i]['Problem_result'] == ''){
                        $doc = array(                 
                            'Problem_id' =>$docs[$i]['Problem_id'], // id สำหรับเวลาส่งกลับมาเราจะได้รู้ว่าเป็น Problem_id ไหน 
                            'Datetime_problem' => "วันที่ ".$datefound." เวลา ".$timefound,                     
                            'Time_problem' => $timefound,
                            'Problem_detail' =>$docs[$i]['Problem_detail'],
                            'Person_follow' =>$docs[$i]['Person_follow'],
                            'Date_follow' =>"วันที่ ".$dateproblem." เวลา ".$timeproblem,    
                        );        

                        // TODO ถ้าเป็นวันนี้และถึงเวลาตามปัญหาแล้ว จะ push ไปเข้าตัวแปรถึงกำหนด แต่ถ้ายังไม่ถึงจะไปเข้าตัวอื่นๆ
                        if($datenow == $datecheck){ // ถ้าปัญหาตอนเช้า (Problem_detail1) เป็นของวันนี้จะแสดงว่าต้องแจ้งเตือนวันนี้
                            if($timenow >= $timecheck){ // ถ้าปัญหาตอนเช้า (Problem_detail1) เป็นเวลาปัจจุบัน หรือเลยเวลามาแล้ว จะแจ้งเตือนออกไป
                                array_push($resultreach, $doc);
                            }
                            elseif($timenow < $timecheck){
                                array_push($resultgoing, $doc);
                            }
                        }
                        elseif($datenow > $datecheck){ // ถ้าวันนี้มากกว่าวันของปัญหาแสดงว่าเกินกำหนดมาแล้วต้องให้ติดตามเดี๋ยวนี้
                             array_push($resultreach, $doc);
                        }
                        elseif($datenow < $datecheck){ // ถ้าวันนี้น้อยกว่าวันของปัญหาแสดงว่ายังไม่ถึงกำหนด
                             array_push($resultgoing, $doc);
                        }
                }
                //TODO ถ้ามีข้อมูลในช่องการแก้ไขปัญหาแล้ว จะเข้าไปในแก้ปัญหาแล้ว
                if($docs[$i]['Problem_result'] != ''){
                                      
                    $doc = array(                 
                        'Datetime_problem' => "วันที่ ".$datefound." เวลา ".$timefound,                     
                        'Time_problem' => $timefound,
                        'Problem_detail' =>$docs[$i]['Problem_detail'],
                        'Person_follow' =>$docs[$i]['Person_follow'],
                        'Problem_result' =>$docs[$i]['Problem_result'],       
                    );
                    array_push($resultdone, $doc);
                    
                }
            
        }
        
        return array(
            'result' => $resultreach,
            'result2' => $resultgoing,
            'result3' => $resultdone,
        );
    }




}

?>