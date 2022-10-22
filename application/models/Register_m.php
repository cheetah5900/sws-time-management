<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Register_m extends CI_Model {

    //เพิ่มข้อมูลเข้าสู่ฐานข้อมูล
    public function register()
	{
        // ตรวจสอบว่ามี Username นี้ในระบบหรือยัง
        $Username = $this->input->post('Username');
        $chkdupuser = $this->db->query("SELECT * FROM person WHERE Username = '$Username'");
        $chknum = $chkdupuser->num_rows();

        if($chknum>0){
            $popup = 'ซ้ำ';
            return $popup;
        }
        else{
            //รับค่า person เข้าตัวแปร
            $datainsert = array(
                'Person_name' => $this->input->post('Person_name'),
                'Person_sname' => $this->input->post('Person_sname'),
                'Person_niname' => $this->input->post('Person_niname'),
                'Position' => $this->input->post('Position'),
                'Phone' => $this->input->post('Phone'),
                'Department' => $this->input->post('Department'),
                'Username' => $this->input->post('Username'),
                'Password' => $this->input->post('Password'),
                'Level' => 'Officer',
                'Person_status' => 'Active'
            );            
            // SQL Update
            $this->db->insert('person',$datainsert);

            // ดึง ai ล่าสุดมา แล้วตั้งเป็นชื่อไฟล์
            $query = $this->db->query("SELECT Person_id FROM person ORDER BY Person_id DESC LIMIT 1");
            $pulllastvenai = $query->row();
            $pulllastvenai2 = $pulllastvenai->Person_id;

            // เอาไฟล์เข้าฐานข้อมูล
            $file_name = 'Person_'.$pulllastvenai2;
            $filefield = 'File_person';
            $location = 'file/person';            
            $filename = $this->Person_m->fileupload($filefield,$file_name,$location);
            if($filename == 'ไฟล์ผิด'){ // ถ้าไฟล์ผิดให้ลบรายการผู้รับเงินล่าสุดออกจากฐานข้อมูล
                $datadelete = array('Person_id'=>$pulllastvenai2);
                $this->db->delete('person',$datadelete);          
                return $filename;
            } // ถ้าไฟล์ผิดจะล้มเลิกการทำงานทันที
            else{                   
                // อัพเดทชื่อไฟล์ลงใน Person รายการล่าสุด
                $dataupdate = array('File_person' => $filename);
                $this->db->where('Person_id',$pulllastvenai2);
                $this->db->update('person',$dataupdate);       
            }

        }

	}

}

?>