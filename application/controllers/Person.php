<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Person_m');
		$this->load->library("pagination");
	}
	public function index()
	{


		$config = array();
        $config["base_url"] = site_url() . "/person/index";
        $config["total_rows"] = $this->Person_m->listperson_count();
        $config["per_page"] = 5;
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


		$mode = $this->input->get('mode'); //รับตัวแปร mode
		$id = $this->input->get('id'); //รับตัวแปร id
		$done = $this->input->get('done');

		//รับไอดีมาตรวจสอบและแสดงการแจ้งเตือน
		if ($done=='adddone'){$popup = array('color' => 'green','popup' => 'เพิ่มข้อมูลสำเร็จ');}
		elseif ($done=='editdone'){$popup = array('color' => 'green','popup' => 'แก้ไขข้อมูลสำเร็จ');}
		elseif ($done=='deldone'){$popup = array('color' => 'green','popup' => 'ลบข้อมูลสำเร็จ');}
		elseif ($done=='duperr'){$popup = array('color' => 'green','popup' => 'มี Username นี้ในระบบแล้ว กรุณาใช้ Username อื่น');}
		elseif ($done=='filewrg'){$popup = array('color' => 'red','popup' => 'กรุณาอัพโหลดไฟล์ pdf zip rar jpg jpeg png เท่านั้น หากยังติดปัญหากรุณาติดต่อผู้ดูแลระบบ');}
		else{$popup = array('color' => '','popup' => '');}


		
		//เช็คโหมดของการทำงาน
		if($mode=='add'){
			$popup = $this->Person_m->add_person($id);
			if($popup == 'ไฟล์ผิด'){redirect(site_url('person?done=adddone'), 'refresh');}
			if($popup == 'ซ้ำ'){redirect(site_url('person?done=duperr'), 'refresh');}
			else{redirect(site_url('person?done=adddone'), 'refresh');}
		}
		if($mode=='editdata'){			
			$popup = $this->Person_m->edit_dataqry();
			if($popup == 'ไฟล์ผิด'){redirect(site_url('person?done=adddone'), 'refresh');}
			if($popup == 'ซ้ำ'){redirect(site_url('person?done=duperr'), 'refresh');}
			else{redirect(site_url('person?done=adddone'), 'refresh');}
		}
		if($mode=='del'){
			$popup = $this->Person_m->del_Person($id);
			if($popup == 'ไฟล์ผิด'){redirect(site_url('person?done=adddone'), 'refresh');}
			else{redirect(site_url('person?done=adddone'), 'refresh');}
		}

		//ส่วนแสดงข้อมูล
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('topbar',$popup);

		//ถ้าเป็นโหมด edit จะแสดงแค่หน้าเดียวอันอื่นไม่ต้องเข้ามา
		if($mode=='edit'){
			$data = array(
				'query' => $this->Person_m->readperson($id),

			);
			$this->load->view('person/person_edit', $data);		
		}
		else{
			//ดึงข้อมูล ในฐานข้อมูลออกมาแสดงในตาราง
			$docs = $this->Person_m->showdata($id);
			$head = $this->Person_m->listpersonhead($id);
			$props = array(
				'persons' => $docs, 
				'listhead' => $head,
				'links' => $this->pagination->create_links(),
				'total_rows' => $this->Person_m->listperson_count(),
			);

			$this->load->view('person/person', $props);
		}
			$this->load->view('footer');

	}


	//หน้า view ภาพรวม ของ user เมื่อกดปุ่มแก้ไขมา เราจะโยนให้มันไปคิดต่อใน model แล้วแสดงหน้า edit ขึ้นมาพร้อมข้อมูลวางไว้ให้เรียบร้อย
	public function clicktoedit($Person_id)
	{
		$data = array(	'query' => $this->Person_m->readperson($Person_id),
						'result' => $this->Person_m->listperson()
					);
		//ดึงข้อมูลรายชื่อผรม.สำหรับเลือกใส่แต่ละคน

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('topbar');
		$this->load->view('person/person_edit', $data);
		$this->load->view('footer');
	}
	// เมื่อ view หน้าเพิ่มข้อมูล กดยืนยันเพิ่มข้อมูล จะส่งมาที่ Controller แล้วส่งต่อไปยัง Model เพื่อดำเนินการคำสั่งเพิ่มต่อไป
	public function adddata()
	{
		$this->Person_m->add_person();
		redirect(site_url('person?done=adddone'), 'refresh');
	}
	// เมื่อหน้า view กดยืนยันแก้ไขข้อมูล จะส่งมาที่ Controller แล้วส่งต่อไปยัง Model เพื่อดำเนินการคำสั่งแก้ไขต่อไป
	public function editdata()
	{
		$this->Person_m->edit_person();
		redirect(site_url('person?done=editdone'), 'refresh');
	}
	// เมื่อหน้ารวม view กดยืนยันลบข้อมูล จะส่งมาที่ Controller แล้วส่งต่อไปยัง Model เพื่อดำเนินการคำสั่งลบต่อไป
	public function clicktodel($Person_id)
	{
		$this->Person_m->del_person($Person_id);
		redirect(site_url('person?done=deldone'), 'refresh');
	}
}
