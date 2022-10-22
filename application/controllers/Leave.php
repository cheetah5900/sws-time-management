<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Leave_m');
		$this->load->library("pagination");
	}
	public function index()
	{		
		
		$config = array();
        $config["base_url"] = site_url() . "/leave/index";
        $config["total_rows"] = $this->Leave_m->listTimeleave_count();
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
 		
		// //เช็คโหมดของการทำงาน
		$mode = $this->input->get('mode'); //รับตัวแปร mode
		
		//ดึงข้อมูล time_leave ในฐานข้อมูลออกมาแสดงในตาราง
		$docs = $this->Leave_m->showdata();
		$docs2 = $this->Leave_m->showdetailtoday();

			$props = array(
				'leaves' => $docs,
				'data' => $docs2,
				'links' => $this->pagination->create_links(),
				'total_rows' => $this->Leave_m->listTimeleave_count(),
			); 
		//รับไอดีมาตรวจสอบและแสดงการแจ้งเตือน
		$done = $this->input->get('done');
		if ($done=='logindone'){$popup = array('color' => 'green','popup' => 'เช็คชื่อสำเร็จ');}
		elseif ($done=='loginm'){$popup = array('color' => 'red','popup' => 'เช็คชื่อช่วงเช้าไปแล้ว');}
		elseif ($done=='logina'){$popup = array('color' => 'red','popup' => 'เช็คชื่อช่วงบ่ายไปแล้ว');}
		elseif ($done=='logina'){$popup = array('color' => 'red','popup' => 'เช็คชื่อช่วงเย็นไปแล้ว');}
		elseif ($done=='editwrg'){$popup = array('color' => 'red','popup' => 'กรุณาเพิ่มผลการทำงาน');}
		else{$popup = array('color' => '','popup' => '');}


		if($mode=='loginm'){
			$popup = $this->Leave_m->time_loginm();
			if ($popup=='เช็คชื่อเช้า'){redirect(site_url('leave?done=loginm'), 'refresh');}
			else{redirect(site_url('leave?done=logindone'), 'refresh');}
		}
		if($mode=='logina'){
			$popup = $this->Leave_m->time_logina();

			if ($popup=='เช็คชื่อบ่าย'){redirect(site_url('leave?done=logina'), 'refresh');}
			else{redirect(site_url('leave?done=logindone'), 'refresh');}
		}
		if($mode=='logout'){
			$popup = $this->Leave_m->time_logout();
			if ($popup=='เช็คชื่อเย็น'){redirect(site_url('leave?done=logout'), 'refresh');}
			else{redirect(site_url('leave?done=logindone'), 'refresh');}
		}
		//ส่วนแสดงข้อมูล
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('topbar',$popup);	
			$this->load->view('leave', $props);
			$this->load->view('footer');

	}



}