<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home_m extends CI_Model {

    /*-------------------------------------------FETCH DATA-------------------------------------------*/
    /*-------------------------------------------FETCH DATA-------------------------------------------*/
    /*-------------------------------------------FETCH DATA-------------------------------------------*/

    // เอาไว้ให้ Showdata ดึงข้อมูลไป fetch เพื่อแสดงข้อมูล
	function listDisburse() {
		$this->db->from('disburse');
		$where = "disburse.Status = 'Active' OR disburse.Status = 'Waitapp'";
		$this->db->where($where);
		$query = $this->db->get();
       	return $query->result_array();
    }   
        // แสดงรายการเดือนที่ตรงกับเดือนที่ต้องการ
        function Disbursemonth($Month) {
                $this->db->from('disburse');
                $where = "(disburse.Status = 'Active' OR disburse.Status = 'Waitapp') AND MONTH(Disburse_actual) = $Month";
                $this->db->where($where);
                $query = $this->db->get();
                return $query->result_array();
        }   

       
    //ดึงข้อมูลมาแสดงในตารางที่บี๋ทำให้ จะมีตัวเลขไปนับให้ด้วย
    public function showdata()
    {
        $docs = $this->listDisburse();
        $sum = 0; // สร้างตัวแปรให้ก่อนทีนึง ระบบจะได้ไม่งง
        $sumpaid = 0;
        $sumvendor = 0;
        $sumgen = 0;
        $sumpo = 0;
        $sumelecwork = 0;

            /* รวมยอดทั้งหมด เบิกแล้ว และรอเบิก */
                for ($p = 0; $p < count($docs); $p++) { // เอาจำนวน Disburse_id ทั้งหมดจาก listDisburse มาใส่และรวมผลรวมทั้งหมด
                        $Disburse_id = $docs[$p]['Disburse_id'];
                        $distype = $docs[$p]['Disburse_type'];
                        $dispercent = $docs[$p]['Disburse_swspercent'];
                        
                        $sumvalue = $this->Disburse_m->choosesumvalue($Disburse_id,$distype,$dispercent); // เอาไปใส่ function ให้มันคิดเอาว่าตอนนี้เป็นประเภทอะไร และจะรวมผลลัพธ์แบบไหน   

                        /* ทำเบิกทีละประเภทเพื่อแยกตัวแปรส่งไป */
                        if($distype == 'เบิกจ่ายผู้รับเหมา'){
                                $sumvendor = $sumvalue;
                        }                    
                        elseif($distype == 'เบิกจ่ายทั่วไป'){
                                $sumgen = $sumvalue;
                        }   
                        elseif($distype == 'เบิกจ่ายค่าอุปกรณ์'){
                                $sumpo = $sumvalue;
                        }   
                        elseif($distype == 'เบิกจ่ายค่าพาดสาย'){
                                $sumelecwork = $sumvalue;
                        }   

                        $sum = $sum + $sumvalue; // $sum คือผลรวมค่า Disburse จากทุก Disburse มาแล้ว ไม่ใช่ทีละรายการ

                        $sumdisalready = $this->Disburse_round_m->sumvaluedis_round_add($Disburse_id); // รวมจำนวนที่เบิกไปแล้วของ Work นั้นๆ
                        $sumpaid = $sumpaid + $sumdisalready; // #sumpaid คือผลรวมเงินที่จ่ายไปแล้วทั้งหมด ไม่ใช่ทีละรายการ
                }
                $remainvalue = $sum - $sumpaid; // ยอดเต็มลบออกจากยอดที่เบิกไปแล้วจะได้ยอดคงเหลือ
        
             /* คำร้องพาดสายและรอคืนเงิน*/             
             $list = $this->Elecwork_m->listelecwork();
             $elecremain = 0;
             $elecdone = 0;
             $result = array();
             
             for ($p = 0; $p < count($list); $p++) { // เอาจำนวน Disburse_id ทั้งหมดจาก listDisburse มาใส่และรวมผลรวมทั้งหมด
                        $Elecwork_status = $list[$p]['Elecwork_status'];
                        if($Elecwork_status == 'รอโอน'){
                                $elecremain = $elecremain + 1;
                        }
                        elseif($Elecwork_status == 'คืนแล้ว' || $Elecwork_status == 'คืนแล้ว(App)'){
                                $elecdone = $elecdone + 1;
                        }
             }



             /* ยอดเบิกแต่ละเดือนแสดงในกราฟ */             
                $docs = $this->listDisburse(); // เอารายการเบิกแต่ละรายการออกมาเทียบ

                // กำหนดค่าให้ตัวแปรลอยๆไว้ก่อน ถ้าไม่มีค่ามันจะได้ไม่ Error
                for ($g = 1; $g < 13; $g++) { // วนลูปไปให้ครบ 12 เดือน
                        ${"month".$g} = 0;
                        ${"summonth".$g} = 0;
                }
                for ($p = 0; $p < count($docs); $p++) { 
                        $Disburse_actual = $docs[$p]['Disburse_actual']; // ดึงเอา วันที่โอนจริงออกมา
                        $Disburse_id = $docs[$p]['Disburse_id']; // ดึงไอดีออกมา เพื่อจะเอาไปหาว่ามีผลรวมเท่าไร
                        $Disburse_type = $docs[$p]['Disburse_type']; // ดึงประเภทออกมาว่าตัวที่เป็นเดือนดังกล่าวนั้นมีประเภทเป็นอะไรจะได้ไปรวมถูก
                        
        
                    // ดึงเดือนที่โอนแล้วของแต่ละการเบิกจ่ายออกมา
                    if($Disburse_actual != '0000-00-00'){
                        $dateact = new DateTime($Disburse_actual); // เปลี่ยนให้กลายเป็นรูปแบบวันที่
                        $Month = $dateact->format('m'); // แปลงให้ออกเฉพาะเลขเดือนแบบมี เลขศูนย์นำหน้า

                        // ถ้ามีเลขเดือนดังกล่าว ให้รวมว่าเบิกแล้วเท่าไร
                       for ($k = 1; $k < 13; $k++) { // วนลูปไปให้ครบ 12 เดือน
                            if($Month == $k){ // ถ้าเดือนที่ดึงมาจาก Disburse_actual ( $Month ) เท่ากับจำนวนเดือน 1 ใน 12 อันไหนจะเข้าอันนั้น เช่น เดือนจาก Disburse_actual มาเป็น 05 มันก็จะวนตัว $k หา 05ให้เจอ ถ้าเจอก็จะเอาค่าไปเก็บด้านในต่อไป
                                ${"month".$k} = $this->Disburse_round_m->sumvaluedis_round_add($Disburse_id); // เอาค่าไปใส่ $month ตัวที่ 05 เป็นค่ามาใหม่
                                ${"summonth".$k} = ${"summonth".$k} + ${"month".$k}; // เอาค่าที่มาใหม่ไปรวมกับ summonth ตัวที่ 05 เพื่อรวมเฉพาะเดือน 05 เข้าด้วยกัน
                            }
                       }
                    }
                }



              /* รวมผลลัพธ์ของแต่ละประเภทการเบิกจ่าย */
              $docs = $this->listDisburse(); // เอารายการเบิกแต่ละรายการออกมาเทียบ
              
                // กำหนดค่าให้ตัวแปรลอยๆไว้ก่อน ถ้าไม่มีค่ามันจะได้ไม่ Error
                $listtype = $this->Type_work_gen_m->listtype_work_gen(); // ใช้ดึงข้อมูลของประเภทการเบิกจ่ายทั่วไป และสำหรับนักข้อมูล
                
                $Allgen_value = 0;
                // วนเอาสร้างตัวแปรรวมประเภทสำหรับเดือนทั้ง 12 เดือน
                for ($m = 1; $m < 13; $m++){
                        ${"Sum_valueofeachtype".$m} = 0;
                }
                for ($j = 0; $j < count($listtype); $j++){ // วนลูปเพื่อดึง id ของประเภทการเบิกจ่ายทั่วไป ออกมาจากตารางทุกรายการ
                        $u = $j + 1;
                        for ($m = 1; $m < 13; $m++){// วนลูปเพื่อสร้างเป็นเดือนทั้ง 12 เดือน
                                ${"Sum_valueofeachtype_month".$u.'_'.$m} = 0;
                        }
                }

                for ($p = 0; $p < count($docs); $p++) { 
                        $Disburse_id = $docs[$p]['Disburse_id']; // ดึงไอดีออกมา เพื่อจะเอาไปหาว่ามีผลรวมเท่าไร
                        $Disburse_type = $docs[$p]['Disburse_type']; // ดึงประเภทออกมาว่าตัวที่เป็นเดือนดังกล่าวนั้นมีประเภทเป็นอะไรจะได้ไปรวมถูก
                        $Disburse_actual = $docs[$p]['Disburse_actual']; // ดึงเอา วันที่โอนจริงออกมา
                
                        if($Disburse_type == 'เบิกจ่ายทั่วไป'){ // ถ้าประเภทของการเบิกจ่าย เป็นเบิกจ่ายทั่วไปจะเข้าเงื่อนไขนี้เพื่อไปทำกราฟ Pie
                                if($Disburse_actual != '0000-00-00'){ 
                                        // ดึงเดือนที่โอนแล้วของการเบิกจ่ายออกมา แล้วแปลงเอาเฉพาะเดือนเพื่อไว้เทียบเข้าตัวแปรต่อไป
                                        $dateact = new DateTime($Disburse_actual); // เปลี่ยนให้กลายเป็นรูปแบบวันที่
                                        $Month = $dateact->format('m'); // แปลงให้ออกเฉพาะเลขเดือนแบบมีเลขศูนย์นำหน้า

                                        $Dgen = $this->Disburse_gen_m->listDisburse_gen($Disburse_id); // ดึงค่าของ Disburse_gen ใน Disburse_id นี้ออกมาทั้งหมด
                                        for ($g = 1; $g < count($Dgen)+1; $g++) { // วนตัวเลขเท่าจำนวนรายการย่อยการเบิกจ่ายทั่วไปของการเบิกจ่ายหลักนี้
                                                // ${"CountTypewgid".$g} = 0; // สร้างตัวแปร CountTypewgid เท่ากับรายการย่อยการเบิกจ่ายทั่วไปของการเบิกจ่ายหลักนี้
                                                ${"Gen_value".$g} = 0;
                                                ${"Sum_valueofeachtype".$g} = 0;
                                        }

                                        for ($k = 0; $k < count($Dgen); $k++) { // เอารายการย่อยในการเบิกจ่ายทั่วไป ทุกรายการมาวนออกให้ครบ เช่น เบิกจ่ายทั่วไป (Disburse_id) นี้มีรายการย่อย 10 รายการ ก็วน 10 รายการเพื่อเอาข้อมูลออกมา
                
                                                $Gen_value = $Dgen[$k]['Gen_value']; // ดึงจำนวนออกมาจากแต่ละรายการเบิกจ่าย
                                                $Typewgid = $Dgen[$k]['Type_work_gen_id']; // ดึงประเภทออกมาจากแต่ละรายการเบิกจ่าย  

                                                // เอา id ของตารางประเภทการเบิกจ่ายทั่วไป (type_work_gen) ออกมาเรียงทั้งหมด เพื่อเทียบกับ id ของประเภทเบิกจ่ายทั่วไปจากตาราง disburse_gen
                                                for ($j = 0; $j < count($listtype); $j++){
                                                        $listtypewgid = $listtype[$j]['Type_work_gen_id']; // ดึงประเภทการเบิกจ่ายทั่วไปออกมาเก็บใส่ตัวแปร จะได้ใช้งานง่ายๆ
                                                        if($Typewgid == $listtypewgid){ // ถ้าค่าจากทั้งสองตารางเท่ากัน

                                                                $u = $j+1; // เอาเลข $j ของ loop มาเพิ่มเพื่อตั้งชื่อตัวแปร ไม่ให้เริ่มจาก 0
                                                                // นับจำนวนของแต่ละประเภทว่ามีเท่าไร
                                                                // ${"CountTypewgid".$u} = ${"CountTypewgid".$u} + 1; // ทุกครั้งที่มีประเภทเบิกจ่ายทั่วไปเข้ามา ตัวแปรนี้จะบวกหนึ่ง ไปเรื่อยๆ และจะสามารถบอกได้ว่า แต่ละประเภทนั้นมีการเบิกแบบไหนจำนวนเท่าไร
                                                                
                                                                $Allgen_value = $Allgen_value + $Gen_value; // ตัวแปรที่จะรวมค่าของทุกประเภทเข้ามาเพื่อไปเป้นจำนวนทั้งหมด

                                                                ${"Sum_valueofeachtype".$u} = ${"Sum_valueofeachtype".$u} + $Gen_value;  // เอาจำนวนเงินของรายการเบิกจ่ายย่อยมาใส่ในตัวแปรของแต่ละประเภท
                                                                // แล้วค่าด้านบนนี้เป็นของเดือนไหน ?
                                                                for ($m = 1; $m < 13; $m++){// เอาเดือนของการเบิกจ่ายมาเทียบกับ เดือนทั้ง 12 ว่าเป็นเดือนไหน
                                                                        if($Month == $m){ // ถ้าเดือนของรายการเบิกจ่ายหลักเป็นเดือนที่เท่าไร มันก็จะใส่จำนวนเข้าไปในตัวแปรของเดือนนั้น
                                                                                 ${"Sum_valueofeachtype_month".$u.'_'.$m} = ${"Sum_valueofeachtype_month".$u.'_'.$m} + $Gen_value;
                                                                        }
                                                                }
                                                        }
                                                }
                                        }
                                }                                
                        }
                }

             /* ส่วนส่งข้อมูลไปยังหน้าแสดงผล */
                    $doc = array(
                        'Work_value' => number_format($sum,2).' บาท',
                        'Paid' => number_format($sumpaid,2).' บาท',
                        'Remain_value' => number_format($remainvalue,2).' บาท',
                        'Elecwork' => 'คืนแล้ว : '.$elecdone.' คงเหลือ : '.$elecremain,
                        'Sumvendor' => number_format($sumvendor,2).' บาท',
                        'Sumgen' => number_format($sumgen,2).' บาท',
                        'Sumpo' => number_format($sumpo,2).' บาท',
                        'Sumelecwork' => number_format($sumelecwork,2).' บาท',
                        'summonth1' => $summonth1,
                        'summonth2' => $summonth2,
                        'summonth3' => $summonth3,
                        'summonth4' => $summonth4,
                        'summonth5' => $summonth5,
                        'summonth6' => $summonth6,
                        'summonth7' => $summonth7,
                        'summonth8' => $summonth8,
                        'summonth9' => $summonth9,
                        'summonth10' => $summonth10,
                        'summonth11' => $summonth11,
                        'summonth12' => $summonth12,
                        'Allgen_value' => $Allgen_value,
                        'Sum_valueofeachtype1' => $Sum_valueofeachtype1,
                        'Sum_valueofeachtype2' => $Sum_valueofeachtype2,
                        'Sum_valueofeachtype3' => $Sum_valueofeachtype3,
                        'Sum_valueofeachtype4' => $Sum_valueofeachtype4,
                        'Sum_valueofeachtype5' => $Sum_valueofeachtype5,
                        'Sum_valueofeachtype_month1_1' => $Sum_valueofeachtype_month1_1,
                        'Sum_valueofeachtype_month1_2' => $Sum_valueofeachtype_month1_2,
                        'Sum_valueofeachtype_month1_3' => $Sum_valueofeachtype_month1_3,
                        'Sum_valueofeachtype_month1_4' => $Sum_valueofeachtype_month1_4,
                        'Sum_valueofeachtype_month1_5' => $Sum_valueofeachtype_month1_5,
                        'Sum_valueofeachtype_month1_6' => $Sum_valueofeachtype_month1_6,
                        'Sum_valueofeachtype_month1_7' => $Sum_valueofeachtype_month1_7,
                        'Sum_valueofeachtype_month1_8' => $Sum_valueofeachtype_month1_8,
                        'Sum_valueofeachtype_month1_9' => $Sum_valueofeachtype_month1_9,
                        'Sum_valueofeachtype_month1_10' => $Sum_valueofeachtype_month1_10,
                        'Sum_valueofeachtype_month1_11' => $Sum_valueofeachtype_month1_11,
                        'Sum_valueofeachtype_month1_12' => $Sum_valueofeachtype_month1_12,
                        'Sum_valueofeachtype_month2_1' => $Sum_valueofeachtype_month2_1,
                        'Sum_valueofeachtype_month2_2' => $Sum_valueofeachtype_month2_2,
                        'Sum_valueofeachtype_month2_3' => $Sum_valueofeachtype_month2_3,
                        'Sum_valueofeachtype_month2_4' => $Sum_valueofeachtype_month2_4,
                        'Sum_valueofeachtype_month2_5' => $Sum_valueofeachtype_month2_5,
                        'Sum_valueofeachtype_month2_6' => $Sum_valueofeachtype_month2_6,
                        'Sum_valueofeachtype_month2_7' => $Sum_valueofeachtype_month2_7,
                        'Sum_valueofeachtype_month2_8' => $Sum_valueofeachtype_month2_8,
                        'Sum_valueofeachtype_month2_9' => $Sum_valueofeachtype_month2_9,
                        'Sum_valueofeachtype_month2_10' => $Sum_valueofeachtype_month2_10,
                        'Sum_valueofeachtype_month2_11' => $Sum_valueofeachtype_month2_11,
                        'Sum_valueofeachtype_month2_12' => $Sum_valueofeachtype_month2_12,
                        'Sum_valueofeachtype_month3_1' => $Sum_valueofeachtype_month3_1,
                        'Sum_valueofeachtype_month3_2' => $Sum_valueofeachtype_month3_2,
                        'Sum_valueofeachtype_month3_3' => $Sum_valueofeachtype_month3_3,
                        'Sum_valueofeachtype_month3_4' => $Sum_valueofeachtype_month3_4,
                        'Sum_valueofeachtype_month3_5' => $Sum_valueofeachtype_month3_5,
                        'Sum_valueofeachtype_month3_6' => $Sum_valueofeachtype_month3_6,
                        'Sum_valueofeachtype_month3_7' => $Sum_valueofeachtype_month3_7,
                        'Sum_valueofeachtype_month3_8' => $Sum_valueofeachtype_month3_8,
                        'Sum_valueofeachtype_month3_9' => $Sum_valueofeachtype_month3_9,
                        'Sum_valueofeachtype_month3_10' => $Sum_valueofeachtype_month3_10,
                        'Sum_valueofeachtype_month3_11' => $Sum_valueofeachtype_month3_11,
                        'Sum_valueofeachtype_month3_12' => $Sum_valueofeachtype_month3_12,
                        'Sum_valueofeachtype_month4_1' => $Sum_valueofeachtype_month4_1,
                        'Sum_valueofeachtype_month4_2' => $Sum_valueofeachtype_month4_2,
                        'Sum_valueofeachtype_month4_3' => $Sum_valueofeachtype_month4_3,
                        'Sum_valueofeachtype_month4_4' => $Sum_valueofeachtype_month4_4,
                        'Sum_valueofeachtype_month4_5' => $Sum_valueofeachtype_month4_5,
                        'Sum_valueofeachtype_month4_6' => $Sum_valueofeachtype_month4_6,
                        'Sum_valueofeachtype_month4_7' => $Sum_valueofeachtype_month4_7,
                        'Sum_valueofeachtype_month4_8' => $Sum_valueofeachtype_month4_8,
                        'Sum_valueofeachtype_month4_9' => $Sum_valueofeachtype_month4_9,
                        'Sum_valueofeachtype_month4_10' => $Sum_valueofeachtype_month4_10,
                        'Sum_valueofeachtype_month4_11' => $Sum_valueofeachtype_month4_11,
                        'Sum_valueofeachtype_month4_12' => $Sum_valueofeachtype_month4_12,
                        'Sum_valueofeachtype_month5_1' => $Sum_valueofeachtype_month5_1,
                        'Sum_valueofeachtype_month5_2' => $Sum_valueofeachtype_month5_2,
                        'Sum_valueofeachtype_month5_3' => $Sum_valueofeachtype_month5_3,
                        'Sum_valueofeachtype_month5_4' => $Sum_valueofeachtype_month5_4,
                        'Sum_valueofeachtype_month5_5' => $Sum_valueofeachtype_month5_5,
                        'Sum_valueofeachtype_month5_6' => $Sum_valueofeachtype_month5_6,
                        'Sum_valueofeachtype_month5_7' => $Sum_valueofeachtype_month5_7,
                        'Sum_valueofeachtype_month5_8' => $Sum_valueofeachtype_month5_8,
                        'Sum_valueofeachtype_month5_9' => $Sum_valueofeachtype_month5_9,
                        'Sum_valueofeachtype_month5_10' => $Sum_valueofeachtype_month5_10,
                        'Sum_valueofeachtype_month5_11' => $Sum_valueofeachtype_month5_11,
                        'Sum_valueofeachtype_month5_12' => $Sum_valueofeachtype_month5_12,
                        'Sum_valueofeachtype_month6_1' => $Sum_valueofeachtype_month6_1,
                        'Sum_valueofeachtype_month6_2' => $Sum_valueofeachtype_month6_2,
                        'Sum_valueofeachtype_month6_3' => $Sum_valueofeachtype_month6_3,
                        'Sum_valueofeachtype_month6_4' => $Sum_valueofeachtype_month6_4,
                        'Sum_valueofeachtype_month6_5' => $Sum_valueofeachtype_month6_5,
                        'Sum_valueofeachtype_month6_6' => $Sum_valueofeachtype_month6_6,
                        'Sum_valueofeachtype_month6_7' => $Sum_valueofeachtype_month6_7,
                        'Sum_valueofeachtype_month6_8' => $Sum_valueofeachtype_month6_8,
                        'Sum_valueofeachtype_month6_9' => $Sum_valueofeachtype_month6_9,
                        'Sum_valueofeachtype_month6_10' => $Sum_valueofeachtype_month6_10,
                        'Sum_valueofeachtype_month6_11' => $Sum_valueofeachtype_month6_11,
                        'Sum_valueofeachtype_month6_12' => $Sum_valueofeachtype_month6_12,
                        'Sum_valueofeachtype_month7_1' => $Sum_valueofeachtype_month7_1,
                        'Sum_valueofeachtype_month7_2' => $Sum_valueofeachtype_month7_2,
                        'Sum_valueofeachtype_month7_3' => $Sum_valueofeachtype_month7_3,
                        'Sum_valueofeachtype_month7_4' => $Sum_valueofeachtype_month7_4,
                        'Sum_valueofeachtype_month7_5' => $Sum_valueofeachtype_month7_5,
                        'Sum_valueofeachtype_month7_6' => $Sum_valueofeachtype_month7_6,
                        'Sum_valueofeachtype_month7_7' => $Sum_valueofeachtype_month7_7,
                        'Sum_valueofeachtype_month7_8' => $Sum_valueofeachtype_month7_8,
                        'Sum_valueofeachtype_month7_9' => $Sum_valueofeachtype_month7_9,
                        'Sum_valueofeachtype_month7_10' => $Sum_valueofeachtype_month7_10,
                        'Sum_valueofeachtype_month7_11' => $Sum_valueofeachtype_month7_11,
                        'Sum_valueofeachtype_month7_12' => $Sum_valueofeachtype_month7_12,
                    );
            
            array_push($result, $doc);
        return $result;
    }

}

?>