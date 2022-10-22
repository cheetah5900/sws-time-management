<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Hr_m');
		$this->load->model('Report_hr_m');
		$this->load->library("pagination");
	}
	public function index()
	{
		$Monthpick = $this->input->get('Monthpick');

		if(!isset($Monthpick)){ // ถ้ากดผ่านช่องกรอง Monthpicker เข้ามาจะทำให้เข้าเงื่อนไขนี้			
			$Monthnow = new DateTime(); // หาเดือนปัจจุบัน
			$Monthpick = $Monthnow->format('m');
		}
		
		$config = array();
        $config["base_url"] = site_url() . "/hr/index";
        $config["total_rows"] = $this->Hr_m->listpersontotimecheck_count($Monthpick);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;		
		$config['first_link'] = '<button class="pagination__link">หน้าแรก</button>';
		$config['last_link'] = '<button class="pagination__link">สุดท้าย</button>';
		$config['next_link'] = '<button class="pagination__link">ถัดไป</button>';
		$config['prev_link'] = '<button class="pagination__link">ย้อนกลับ</button>';
		$config['cur_tag_open'] = '<button class="pagination__link pagination__link--active">';
		$config['cur_tag_close'] = '</button>';
		$config['num_tag_open'] = '<button class="pagination__link">';
		$config['num_tag_close'] = '</button>';
 
        $this->pagination->initialize($config);


	/*--------------------------------------ถ้าเราเลือกกดดูข้อมูลของแผนกอื่นๆ จะเข้าเงื่อนไข detail และเอาข้อมูลของแผนกนั้นๆออกมา แต่ถ้าไม่เลือกเลยจะเอาข้อมูลของแผนกคนล็อกอินเข้ามาแทน--------------------------------------*/

	$btndl = $this->input->get('btndl');

	if(isset($btndl) && $btndl == 'dl'){
		$docs = $this->Report_hr_m->showtime_check($Monthpick);	
	}
	else{
		$docs = $this->Hr_m->showtime_check($Monthpick);	
	}
		
	

		
	/*--------------------------------------/ถ้าเราเลือกกดดูข้อมูลของแผนกอื่นๆ จะเข้าเงื่อนไข detail และเอาข้อมูลของแผนกนั้นๆออกมา แต่ถ้าไม่เลือกเลยจะเอาข้อมูลของแผนกคนล็อกอินเข้ามาแทน--------------------------------------*/

		// รายละเอียดของคนที่ล็อกอินเข้ามาแต่ยังไม่ได้ใส่สรุปรายวัน ต้องแยกกับอีกอันเพราะถ้ายังไม่ได้ใส่สรุปงานรายวันจะไม่สามารถแสดงตัวล่างได้
		
		$data = array(
			'reviews' => $docs,
			'links' => $this->pagination->create_links(),
			'total_rows' => $this->Hr_m->listpersontotimecheck_count($Monthpick),
			'Monthpick' => $Monthpick,
			
		); // ส่ง mode เข้ามาตรวจสอบว่าจะปิดกล่องข้อความหรือไม่
		if(isset($btndl) && $btndl == 'dl'){
			$this->load->view('report_hr',$data);
		}
		else{
			//ส่วนแสดงข้อมูล
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('topbar');		
			$this->load->view('hr',$data);
			$this->load->view('footer');
		}

	}


}
