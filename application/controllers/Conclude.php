<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conclude extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Conclude_m');
	}
	public function index()
	{

		$filter = $this->input->get('filter');

	/*--------------------------------------ถ้าเราเลือกกดดูข้อมูลของแผนกอื่นๆ จะเข้าเงื่อนไข detail และเอาข้อมูลของแผนกนั้นๆออกมา แต่ถ้าไม่เลือกเลยจะเอาข้อมูลของแผนกคนล็อกอินเข้ามาแทน--------------------------------------*/

			if($filter=='filtdate'){ // ถ้ากดผ่านช่องกรอง Datepicker เข้ามาจะทำให้เข้าเงื่อนไขนี้
				$Datepick = $this->input->get('Datepick');
				$datetimes = new DateTime($Datepick); // เอาวันที่ปัจจุบัน มาแปลง format
				$date = $datetimes->format('Y-m-d');
		}
		else{ // แต่ถ้าไม่ได้กรอกก็จะเอาวันปัจจุบัน
				$datetimes = new DateTime(); // เอาวันที่ปัจจุบัน มาแปลง format
				$date = $datetimes->format('Y-m-d');
		}
		echo $date;
			// รายละเอียดของคนที่ล็อกอินและรายละเอียดของวันนี้
			$docs = $this->Conclude_m->showconclude($date);
		
		
	/*--------------------------------------/ถ้าเราเลือกกดดูข้อมูลของแผนกอื่นๆ จะเข้าเงื่อนไข detail และเอาข้อมูลของแผนกนั้นๆออกมา แต่ถ้าไม่เลือกเลยจะเอาข้อมูลของแผนกคนล็อกอินเข้ามาแทน--------------------------------------*/

		$props = array('concludes' => $docs , 'date' => $date); // ส่งไปแสดงข้อมูลที่ตาราง

		// รายละเอียดของคนที่ล็อกอินเข้ามาแต่ยังไม่ได้ใส่สรุปรายวัน ต้องแยกกับอีกอันเพราะถ้ายังไม่ได้ใส่สรุปงานรายวันจะไม่สามารถแสดงตัวล่างได้
	//ส่วนแสดงข้อมูล
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('topbar');		

		// $this->load->view('conclude/conclude_add');
		$this->load->view('conclude/conclude', $props);
	
		$this->load->view('footer');

	}


}
