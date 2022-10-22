<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problem extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Problem_m');
		$this->load->library("pagination");
	}
	public function index()
	{		

		//TODO ถ้าเป็นค่าว่างแสดงว่า ไม่มีปัญหา และถ้าไม่มีปัญหาจะเด้งไปหน้า check ไม่อนุญาตให้เข้าหน้าปัญหา
			$type = $this->input->get('type'); // เอามาเช็คประเภทของปัญหาที่กดเข้ามา ถ้าเข้ามาเป็นประเภทไหนก็จะส่งข้อมูลเข้าไปในตารางแบบนั้น
			$docs = $this->Problem_m->showdatareach();
			$result = $docs['result'];
			//? ถ้าอาเรย์ไม่เป็นค่าว่างแสดงว่ามีปัญหาถึงกำหนด และค่า Type ต้องไม่มีค่า เพราะถ้ามีจะเป็น Type 2 และ 3 ของปัญหาที่ยังไม่ถึงกำหนด
			if(empty($result) && !isset($type)){
				redirect(site_url('check'), 'refresh');
			}			

		//? เอาข้อมูลไปแสดงในตารางโดยให้ ตัวแปร type เป็นตัวตัดสินว่าจะแสดงอันไหนออกมา
		$docs = $this->Problem_m->showdatareach();
		if($type == 2){$result = $docs['result2'];}
		elseif($type == 3){$result = $docs['result3'];}
		else{$result = $docs['result'];}			
		
		
		//? ตรวจสอบว่ามี popup หรือไม่ ถ้ามีจะแสดงตามที่ส่งมา ถ้าไม่มีจะให้เป็นค่าว่าง
		if(!empty($_SESSION['popup'])){ // ถ้ามีแจ้งเตือนเข้ามาจะแสดงแจ้งเตือนดังกล่าว
			$data = $_SESSION['popup'];
		}
		else{ // แต่ถ้าไม่มีจะแสดงเป็นค่าว่าง
			$data = '';
		}

			$props = array(
				'type' => $type,
				'problems' => $result,
				'popup' => $data
			); 

		//ส่วนแสดงข้อมูล
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('topbar');	
			$this->load->view('problem', $props);
			$this->load->view('footer');

	}

	public function fixproblem()
	{
		$this->Problem_m->fixproblem();

		$typefix = $this->input->get('typefix'); // เอามาเช็คประเภทของปัญหาที่กดเข้ามา ถ้าเข้ามาเป็นประเภทไหนก็จะ redirect กลับไปหน้าเดิมพร้อมกับข้อความแจ้งสำเร็จ
		
		if($typefix == 1){ // ถ้าประเภทเป็น 1 แสดงว่ามาจากหน้าปัญหาที่ถึงกำหนด
			$data = array('popup'=>'<br><div class="alert alert-success-soft show flex items-center mb-2" role="alert"> <i data-feather="tool" class="w-6 h-6 mr-2"></i> แก้ไขปัญหาเรียบร้อยแล้ว </div>');
			// i store data to flashdata 
			$this->session->set_flashdata($data);
			// after storing i redirect it to the controller
			redirect(site_url('problem'), 'refresh');
		}
		elseif($typefix == 2){ // ถ้าประเภทเป็น 2 แสดงว่ามาจากหน้าปัญหาที่ยังถึงกำหนด
			$data = array('popup'=>'<br><div class="alert alert-success-soft show flex items-center mb-2" role="alert"> <i data-feather="tool" class="w-6 h-6 mr-2"></i> แก้ไขปัญหาเรียบร้อยแล้ว </div>');
			// i store data to flashdata 
			$this->session->set_flashdata($data);
			// after storing i redirect it to the controller
			redirect(site_url('problem?type=2'), 'refresh');
		}
	}
	public function postpone()
	{		
		$this->Problem_m->postpone();

		$typefix = $this->input->get('typefix'); // เอามาเช็คประเภทของปัญหาที่กดเข้ามา ถ้าเข้ามาเป็นประเภทไหนก็จะ redirect กลับไปหน้าเดิมพร้อมกับข้อความแจ้งสำเร็จ
		if($typefix == 2){ // ถ้าประเภทเป็น 2 แสดงว่ามาจากหน้าปัญหาที่ถึงกำหนด
			redirect(site_url('problem'), 'refresh');
		}
	}

}