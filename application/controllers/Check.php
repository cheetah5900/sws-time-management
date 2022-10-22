<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Check_m');
		$this->load->model('Problem_m');
		$this->load->library("pagination");
	}
	public function index()
	{		
		//TODO ถ้ามีปัญหาที่ถึงกำหนดจะให้ตอบก่อนแล้วค่อยจะเช็คชื่อได้
		$docs = $this->Problem_m->showdatareach();
			$result = $docs['result'];
			//? ถ้าอาเรย์ไม่เป็นค่าว่างแสดงว่ามีปัญหาถึงกำหนด
			if(!empty($result)){
				redirect(site_url('problem'), 'refresh');
			}			

		$config = array();
        $config["base_url"] = site_url() . "/check/index";
        $config["total_rows"] = $this->Check_m->listTimecheck_count();
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
 		
		//เช็คโหมดของการทำงาน
		$mode = $this->input->get('mode'); //รับตัวแปร mode
		
		//ดึงข้อมูล time_check ในฐานข้อมูลออกมาแสดงในตาราง
		$docs = $this->Check_m->showdata();
		
        $datetimes = new DateTime(); // เอาวันที่ปัจจุบัน มาแปลง format
        $datetimes = $datetimes->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $date = $datetimes->format('Y-m-d'); // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้        
        if(isset($_SESSION['Person_id'])){$Person_id = $_SESSION['Person_id'];}else{$Person_id='0';}  
		$docs2 = $this->Check_m->showdetail($date,$Person_id);

			$props = array(
				'checks' => $docs,
				'data' => $docs2,
				'links' => $this->pagination->create_links(),
				'total_rows' => $this->Check_m->listTimecheck_count(),
			); 
		//รับไอดีมาตรวจสอบและแสดงการแจ้งเตือน
		$done = $this->input->get('done');
		if ($done=='chkwrg'){$popup = array('popup' => "<div class='alert alert-danger-soft show flex items-center' role='alert'> <i data-feather='alert-octagon' class='w-6 h-6 mr-2'></i> กรุณาเช็คชื่อเรียงจาก เช้า เที่ยง เย็น </div>");}
		elseif ($done=='editwrg'){$popup = array('popup' => 'กรุณาเพิ่มผลการทำงาน');}
		else{$popup = array('popup' => '');}


		//TODO ถ้ามีปัญหาเข้ามาจะทำให้ไปแจ้งเตือนในกลุ่มด้วย

		$Problem_check = $this->input->post('Problem_check'); // รับตัวแปรว่ามีปัญหาหรือไม่ ถ้ามีก็จะแจ้งเตือนไปที่ไลน์ ถ้าไม่มีก็ไม่ต้องแจ้งเตือน

		if(isset($Problem_check) && $Problem_check == 'มี'){
			$Person_follow = $this->input->post('Person_follow');
			$Problem_detail = $this->input->post('Problem_detail');

			// ? แปลง Timestamp ให้กลายเป็นวันและเวลา
			$Date_follow = $this->input->post('Date_follow');
			$dateformat = new DateTime($Date_follow);
			$datefollow = $dateformat->format('d/m/y');

			$Time_follow = $this->input->post('Time_follow');
			$timeformat = new DateTime($Time_follow);
			$timefollow = $timeformat->format('H.i'); // แปลง Timestamp ให้กลายเป็นเวลาปกติ

			$Person = $_SESSION['Person_niname']." (". $_SESSION['Person_name'].")";

			$problem = array(
				'Problem_detail' => $Problem_detail,
				'Person_follow' => $Person_follow,
				'Date_follow' => $datefollow,
				'Time_follow' => $timefollow,
				'Person' => $Person,
			);
				$this->load->view('linenoti',$problem);
		}


		if($mode=='loginm'){
			$popup = $this->Check_m->time_loginm();
			if ($popup=='เช็คชื่อเช้า'){redirect(site_url('check?done=loginm'), 'refresh');}
			else{redirect(site_url('check'), 'refresh');}			
		}
		if($mode=='logina'){
			$popup = $this->Check_m->time_logina();
			if ($popup=='เช็คชื่อบ่าย'){redirect(site_url('check?done=logina'), 'refresh');}
			elseif ($popup=='ยังไม่ได้เช็คก่อนหน้า'){redirect(site_url('check?done=chkwrg'), 'refresh');}
			else{redirect(site_url('check'), 'refresh');}
		}
		if($mode=='logout'){
			$popup = $this->Check_m->time_logout();
			if ($popup=='เช็คชื่อเย็น'){redirect(site_url('check?done=logout'), 'refresh');}
			elseif ($popup=='ยังไม่ได้เช็คก่อนหน้า'){redirect(site_url('check?done=chkwrg'), 'refresh');}
			else{redirect(site_url('check'), 'refresh');}
		}
		//ส่วนแสดงข้อมูล
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('topbar',$popup);	
			$this->load->view('check', $props);
			$this->load->view('footer');

	}



}