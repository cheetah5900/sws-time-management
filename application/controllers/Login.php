<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_m');
	}
	public function index()
	{
		
		//? ตรวจสอบว่ามี popup หรือไม่ ถ้ามีจะแสดงตามที่ส่งมา ถ้าไม่มีจะให้เป็นค่าว่าง
		if(!empty($_SESSION['popup'])){ // ถ้ามีแจ้งเตือนเข้ามาจะแสดงแจ้งเตือนดังกล่าว
			$data['popup'] = $_SESSION['popup'];
		}
		else{ // แต่ถ้าไม่มีจะแสดงเป็นค่าว่าง
			$data['popup'] = '';
		}

		$this->load->view('header');
		$this->load->view('login',$data);
	}
	public function validation() {
	
        $Username = $this->input->post('Username');
        $Password = $this->input->post('Password');
        $sql = $this->Login_m->vali($Username,$Password);
        if($sql == 'ไม่ถูกต้อง'){
			$data = array('popup'=>'<br><div class="alert alert-danger-soft show flex items-center mb-2" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ชื่อหรือรหัสผ่านไม่ถูกต้อง </div>');
			// i store data to flashdata
			$this->session->set_flashdata($data);
			// after storing i redirect it to the controller
			redirect('login');
        }
		else{
           $session = array(
				'Username' => $sql->Username,
				'Level' => $sql->Level,
				'Department' => $sql->Department,
				'Person_id' => $sql->Person_id,
				'Person_name' => $sql->Person_name,
				'Person_sname' => $sql->Person_sname,
				'Person_niname' => $sql->Person_niname,
				'File_person' => $sql->File_person
		   );
			$this->session->set_userdata($session);
			$this->session->userdata();

			redirect(site_url());
		}
    }
	public function logout() {
	
		$this->session->sess_destroy();
		redirect(site_url('login'), 'refresh');
		
    }
}
