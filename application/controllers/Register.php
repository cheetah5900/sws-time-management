<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Register_m');
		$this->load->model('Person_m');
	}
	public function index()
	{
		// รับค่าตัวแปร get
		$mode = $this->input->get('mode');
		$wrg = $this->input->get('wrg');

		// ดูว่ามี error หรือไม่ จะได้ส่งค่า popup ให้ถูกต้อง
		if($wrg == 1){$popup = array('popup' => 'มี Username นี้ในระบบแล้ว กรุณาใช้ Username อื่น');}
		else{$popup = array('popup' => '');}

		// ส่วนแสดงผล
		$this->load->view('header');

		// ถ้าโหมดเป็น add
		if($mode == 'add')
		{
				$popup = $this->Register_m->register(); // ทำอันนี้เพื่อหาค่าว่าซ้ำหรือไม่

				if ($popup=='ซ้ำ'){redirect('register?wrg=1');} // ถ้าซ้ำเด้งกลับไปหน้าเดิมพร้อม error
				else{$this->load->view('register_done'); // ถ้าไม่ซ้ำให้โหลดหน้าสำเร็จ
				}
		}
		else{
			$this->load->view('register' ,$popup);
		}
	}
		

	
}
