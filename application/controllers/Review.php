<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Review_m');
		$this->load->library("pagination");
	}
	public function index()
	{
        $datetimes = new DateTime(); // เอาวันที่ปัจจุบัน มาแปลง format
        $datetimes = $datetimes->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $date = $datetimes->format('Y-m-d'); // แปลงเป็น ปีเดือนวัน เพื่อจะได้เทียบกับฐานข้อมูลได้
        $Department = $_SESSION['Department'];
		$config = array();
        $config["base_url"] = site_url() . "/review/index";
        $config["total_rows"] = $this->Review_m->listpersontotimecheck_count($date,$Department);
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
		$done = $this->input->get('done');
		$filter = $this->input->get('filter');
		$Datepick = $this->input->post('Datepick');
		$depart = $this->input->get('depart'); //รับตัวแปร depart เพื่อบอกว่ากดแผนกไหนเข้ามา แล้วจะได้ใช้ส่งต่อตอนส่งจาก Datepicker เลือกวันดูข้อมูล

		//รับไอดีมาตรวจสอบและแสดงการแจ้งเตือน
		if ($done=='appdone'){$popup = array('color' => 'green','popup' => 'อนุมัติงานสำเร็จ');}
		else{$popup = array('color' => '','popup' => '');}

		
		//เช็คโหมดของการทำงาน
		if($mode=='approve'){
			$tid = $this->input->get('tid'); //รับตัวแปร Time_id
			$popup = $this->Review_m->work_approve($tid);
			redirect(site_url('review?done=appdone'), 'refresh');
		}
		if($mode=='add'){ // เพิ่มผลสรุปงานแต่ละแผนก
			$popup = $this->Review_m->add_review();
			redirect(site_url('review'), 'refresh');
		}


	/*--------------------------------------ถ้าเราเลือกกดดูข้อมูลของแผนกอื่นๆ จะเข้าเงื่อนไข detail และเอาข้อมูลของแผนกนั้นๆออกมา แต่ถ้าไม่เลือกเลยจะเอาข้อมูลของแผนกคนล็อกอินเข้ามาแทน--------------------------------------*/

		// ถ้าเป็นโหมด detail ค่าจาก docs จะเป็นตามตัวที่เรากด ถ้าไม่ใช่ จะเป็นตัวหลักของแผนกเรา เช่นเราอยู่ design พอเข้ามาทีแรกก็จะลิสต์รายการของ design ออกมาให้เลย
			if($depart=='design'){ // ถ้าแผนกเป็น design
				$Department = 'ออกแบบ (Design)';
			}
			elseif($depart=='tams'){ // ถ้าแผนกเป็น design
				$Department = 'ขออนุญาตไฟฟ้า (TAMS)';
			}
			elseif($depart=='other'){ // ถ้าแผนกเป็น design
				$Department = 'อื่นๆ (Other)';
			}
			elseif($depart=='admin'){ // ถ้าแผนกเป็น design
				$Department = 'เอกสาร (Admin)';
			}		
			if($filter=='filtdate'){ // ถ้ากดผ่านช่องกรอง Datepicker เข้ามาจะทำให้เข้าเงื่อนไขนี้
				    $Datepick = $this->input->post('Datepick');
				    $datetimes = new DateTime($Datepick); // เอาวันที่ปัจจุบัน มาแปลง format
				    $date = $datetimes->format('Y-m-d');
			}
			else{ // แต่ถ้าไม่ได้กรอกก็จะเอาวันปัจจุบัน
					$datetimes = new DateTime(); // เอาวันที่ปัจจุบัน มาแปลง format
					$date = $datetimes->format('Y-m-d');
			}
			$docs = $this->Review_m->showtime_check($date,$Department);		
			$docs2 = $this->Review_m->showconclude($date,$Department);

		
	/*--------------------------------------/ถ้าเราเลือกกดดูข้อมูลของแผนกอื่นๆ จะเข้าเงื่อนไข detail และเอาข้อมูลของแผนกนั้นๆออกมา แต่ถ้าไม่เลือกเลยจะเอาข้อมูลของแผนกคนล็อกอินเข้ามาแทน--------------------------------------*/

	// if(isset($_SESSION['Person_id'])){$personid = $_SESSION['Person_id'];}else{$personid = 0;} // ถ้ายังไม่ล็อคอินจะไม่มีค่า SESSION_ID ให้ใส่ค่ามันเป็น 0 ไป	

		// รายละเอียดของคนที่ล็อกอินเข้ามาแต่ยังไม่ได้ใส่สรุปรายวัน ต้องแยกกับอีกอันเพราะถ้ายังไม่ได้ใส่สรุปงานรายวันจะไม่สามารถแสดงตัวล่างได้
		
		$data = array(
			'data' => $docs2 , 
			'reviews' => $docs,
			'mode' => $mode,
			'links' => $this->pagination->create_links(),
			'total_rows' => $this->Review_m->listpersontotimecheck_count($date,$Department),
			'Datepick' => $Datepick,
			'depart' => $depart
			
		); // ส่ง mode เข้ามาตรวจสอบว่าจะปิดกล่องข้อความหรือไม่
	//ส่วนแสดงข้อมูล
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('topbar',$popup);		

		$this->load->view('review/review',$data);
		// $this->load->view('review/review_view', $props);
	
		$this->load->view('footer');

	}


}
