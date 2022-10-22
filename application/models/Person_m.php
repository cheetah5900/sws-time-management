<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Person_m extends CI_Model {

    //รายชื่อบริษัทต่างๆสำหรับลงข้อมูลชื่อพนักงาน
    public function listperson() {
        
        $this->db->select('*');
        $this->db->from('person');
        $this->db->where("Person_status ='Active'");
        // คำสั่ง limit
        $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit = 5;
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }    
    public function listperson_count() {
        
        $this->db->select('*');
        $this->db->from('person');
        $this->db->where("Person_status ='Active'");
        $docs = $this->db->get();
        return $docs->num_rows();
    }    
    //ดึงข้อมูลกลับมาแสดงในช่องเพื่อรอการแก้ไข
    public function readperson($Person_id)
	{
        $this->db->select('*');
        $this->db->from('person');
        $this->db->where('Person_id',$Person_id);
        $query = $this->db->get();
        if($query->num_rows()>0){
                $data = $query->row();
                return $data;
        }
	}

    //รายชื่อหัวหน้า
    public function listpersonhead() {
        
        $this->db->select('*');
        $this->db->from('person');
        $this->db->where("Person_status ='Active' AND Level = 'Boss'");
        $docs = $this->db->get();
        return $docs->result_array();
    }
    
    public function fileupload($filefield,$file_name,$location)
    {
        //ตั้งค่าไฟล์อัพโหลดรูป
        $config['upload_path'] = './'.$location.'/'; // โฟลเดอร์
        $config['allowed_types'] = 'pdf|zip|rar|jpg|jpeg|png'; // ปรเเภทไฟล์ 
        $config['max_size'] = '2000'; // ขนาดไฟล์ (kb)  0 คือไม่จำกัด ขึ้นกับกำหนดใน php.ini ปกติไม่เกิน 2MB
        $config['max_width'] = '3000'; // ความกว้างรูปไม่เกิน
        $config['max_height'] = '3000'; // ความสูงรูปไม่เกิน
        $config['file_name'] = $file_name;

        $this->load->library('upload',$config);

        //ตรวจสอบว่าอัพโหลดไฟล์สำเร็จมั้ย
        
        if (!$this->upload->do_upload($filefield))
        {   

                $popup = 'ไฟล์ผิด';
                return $popup;
        }
        else
        {
                $data = $this->upload->data();
                $filename = $data['file_name'];
                return $filename;
        }
        
    }
	/*--------------------------------------แสดงรายชื่อออกมาในตาราง--------------------------------------*/
   
    
    //ดึงข้อมูลมาแสดงในตารางที่บี๋ทำให้ จะมีตัวเลขไปนับให้ด้วย
    public function showdata()
    {
        $docs = $this->listperson();
        $result = array();
        for ($i = 0, $j = 1; $i < count($docs); $i++, $j++) {

            $File_person = $docs[$i]['File_person'];
            $Person_id = $docs[$i]['Person_id'];

            // ถ้าไม่มีไฟล์ จะแสดงเป็นคำว่า ไม่มีไฟล์แทน

            if($File_person == '')
            {
                $file = 'ไม่มีรูป';
            }
            else{
                $file = "<a href='".base_url()."file/person/".$File_person."' target='_blank' class='btn btn-success'>ดูรูป</a>";
            }

            $doc = array(
                'no' => $j,
                'Person_id' => $docs[$i]['Person_id'],
                'Person_name' => $docs[$i]['Person_name'],
                'Person_sname' => $docs[$i]['Person_sname'],
                'Person_niname' => $docs[$i]['Person_niname'],
                'Phone' => $docs[$i]['Phone'],
                'Position' => $docs[$i]['Position'],
                'Department' => $docs[$i]['Department'],
                'Username' => $docs[$i]['Username'],
                'Password' => $docs[$i]['Password'],
                'Level' => $docs[$i]['Level'],
                'File_person' => $file,
            );
            array_push($result, $doc);
        }
        return $result;
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
    //เพิ่มข้อมูลเข้าสู่ฐานข้อมูล
    public function add_person()
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
    //ถ้าค่าที่เอาเข้าไปเช็คออกมาแล้วแจ้งว่าไฟล์ผิดจะให้เด้งออกไปแจ้งเตือนทันทีโดยไม่ต้องเปิดอะไรลงฐานข้อมูล
            //รับค่า Person_name เข้าตัวแปร
            $datainsert = array(
                'Person_name' => $this->input->post('Person_name'),
                'Person_sname' => $this->input->post('Person_sname'),
                'Person_niname' => $this->input->post('Person_niname'),
                'Position' => $this->input->post('Position'),
                'Phone' => $this->input->post('Phone'),
                'Department' => $this->input->post('Department'),
                'Username' => $this->input->post('Username'),
                'Password' => $this->input->post('Password'),
                'Level' => $this->input->post('Level'),
                'Person_status' => 'Active'
            );
                //query ข้อมูลเข้าฐานข้อมูล
                $query = $this->db->insert('person',$datainsert);     

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

    //แก้ไขข้อมูลในฐานข้อมูล
    public function edit_dataqry()
	{
 
            $dataedit = array(
                'Person_name' => $this->input->post('Person_name'),
                'Person_sname' => $this->input->post('Person_sname'),
                'Person_niname' => $this->input->post('Person_niname'),
                'Position' => $this->input->post('Position'),
                'Phone' => $this->input->post('Phone'),
                'Department' => $this->input->post('Department'),
                'Password' => $this->input->post('Password'),
                'Level' => $this->input->post('Level')
            );
            // SQL Where Person_id = Person_id
            $this->db->where('Person_id',$this->input->post('Person_id'));
            // SQL Update
            $this->db->update('person',$dataedit);
        
	}

        //ลบ Person ในฐานข้อมูล
        public function del_person($Person_id)
        {
            /*เปลี่ยนสถานะของ Person ให้เป็น inactive เพื่อปิดการใช้งาน*/
            //ตัวแปรกำหนดสถานะของ Person
            $datadel = array('Person_status' => 'Inactive');
            
            // SQL Where Disburse_id = Disburse_id
            $this->db->where('Person_id',$Person_id);
            // SQL Update
            $this->db->update('person',$datadel);
        }

}

?>