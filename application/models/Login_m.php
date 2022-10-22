<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login_m extends CI_Model {

    //รายชื่อบริษัทต่างๆสำหรับลงข้อมูลชื่อพนักงาน


    //ดึงข้อมูลกลับมาแสดงในช่องเพื่อรอการแก้ไข
    public function vali($Username,$Password)
	{
        $sql = $this->db->query("SELECT * FROM person WHERE Username = '$Username' AND Password = '$Password'");
        if($sql->num_rows() <= 0){
            $data = 'ไม่ถูกต้อง';
        }
        else{
            $data = $sql->row();
        }
        return $data;
	}

}

?>