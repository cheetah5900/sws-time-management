<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Webhook {
 
	public function post_controller(){

        $Curpage = site_url(uri_string()); // หน้าปัจจุบัน

        // ตรวจสอบว่ามี SESSION หรือไม่ ถ้ามีจะให้เข้า ถ้าไม่มีให้เด้งกลับมาหน้าล็อคอิน
         If (!isset($_SESSION['Username'])) { // มีตัวแปร SESSION['Username'] หรือไม่
            $Loginpage = site_url('login'); // เอาหน้าล็อคอินไปใส่ตัวแปร
            $Regispage = site_url('register'); // เอาหน้าสมัครสมาชิกไปใส่ตัวแปร
            $Regisdonepage = site_url('register_done'); // เอาหน้าสมัครสมาชิกไปใส่ตัวแปร

            If (($Curpage != $Loginpage) && ($Curpage != $Regispage) && ($Curpage != $Regisdonepage)) { // ถ้าหน้าปัจจุบันที่เปิดอยู่ไม่ใช่หน้า Login ให้เด้งไปที่หน้า Login
                redirect(site_url('login'), 'refresh'); // เด้งไปที่หน้า Login
            }
        }
        
        // จัดการว่าหน้านี้สำหรับ Root เท่านั้น

        $Checkpage = site_url('check'); // หน้าเช็คชื่อ
        $Indexpage = site_url(); // หน้าเช็คชื่อ
        $Personpage = site_url('person'); // หน้าพนักงาน
        $Concludepage = site_url('conclude'); // หน้าพนักงาน
        $Reviewpage = site_url('review'); // หน้าพนักงาน
        $Hrpage = site_url('hr'); // หน้าพนักงาน

        // ถ้าหน้าปัจจุบันเป็นหน้าสำหรับ Root จะไม่มีใครเข้าได้
        if($Curpage == $Personpage || $Curpage == $Concludepage){ 
            if($_SESSION['Level'] != 'Root'){ // ให้ตรวจสอบว่าคนที่เข้าใช่ Root มั้ย ถ้าไม่ใช่ ให้เด้งกลับไปหน้าแรก
                redirect(site_url('check'), 'refresh');
            }
        }
        // Root และ Boss เข้าเช็คชื่อไม่ได้
        // if($Curpage == $Checkpage || $Curpage == $Indexpage){ 
        //     if($_SESSION['Level'] == 'Root' || $_SESSION['Level'] == 'Boss'){ // คนที่เป็นระดับหัวหน้าจะไม่สามารถกดเข้าไปที่หน้าเช็คชื่อได้
        //         redirect(site_url('review'), 'refresh');
        //         exit;
        //     }
        // }
        // ถ้าหน้าปัจจุบันเป็นหน้าสำหรับ Boss และ Root จะไม่มีใครเข้าได้
        if($Curpage == $Reviewpage){ 
            if($_SESSION['Level'] != 'Boss' && $_SESSION['Level'] != 'Root'){ // ให้ตรวจสอบว่าคนที่เข้าใช่ Boss หรือ Root มั้ย ถ้าไม่ใช่ ให้เด้งกลับไปหน้าแรก
                redirect(site_url('check'), 'refresh');
            }
        }
        // ถ้าไม่ได้เป็น HR / Boss / Root จะเข้าหน้านี้ไม่ได้
        if($Curpage == $Hrpage){ 
            if($_SESSION['Level'] != 'Boss' && $_SESSION['Level'] != 'Root' && $_SESSION['Level'] != 'HR'){ // ให้ตรวจสอบว่าคนที่เข้าใช่ Boss หรือ Root มั้ย ถ้าไม่ใช่ ให้เด้งกลับไปหน้าแรก
                redirect(site_url('check'), 'refresh');
            }
        }

}
}
