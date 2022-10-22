                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">ภาพรวม</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
                                                ยอดเบิกทั้งหมด</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $homes[0]['Work_value'];?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-success text-uppercase mb-1">
                                                ยอดเบิกแล้ว</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $homes[0]['Paid'];?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">ยอดรอเบิก
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $homes[0]['Remain_value'];?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">
                                                คำร้องรอคืนเงิน</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $homes[0]['Elecwork'];?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

						<!-- Earnings (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                                เบิกจ่ายผู้รับเหมา</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $homes[0]['Sumvendor'];?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                                เบิกจ่ายทั่วไป</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $homes[0]['Sumgen'];?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-info text-uppercase mb-1">เบิกค่าอุปกรณ์
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $homes[0]['Sumpo'];?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                                เบิกจ่ายค่าพาดสาย</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $homes[0]['Sumelecwork'];?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">ภาพรวมรายจ่ายทั้งปี</h6>
                                    <div class="dropdown no-arrow">
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">     
                                        <div id="Areachart"></div>    
                                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                                        <br><br><br>       
                                    </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-8">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">ประเภทการเบิกจ่ายทั่วไป
</h6>
                                    <div class="dropdown no-arrow">
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">     
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                <button class="btn invisible" id="backButton">&lt; Back</button>
                                    </div>
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



 <!-- สำหรับ Area Chart -->

 <?php
    $dataPoints = array(
    array("x" => 1325356200000, "y" => $homes[0]['summonth1']),
    array("x" => 1328034600000, "y" => $homes[0]['summonth2']),
    array("x" => 1330540200000, "y" => $homes[0]['summonth3']),
    array("x" => 1333218600000, "y" => $homes[0]['summonth4']),
    array("x" => 1335810600000, "y" => $homes[0]['summonth5']),
    array("x" => 1338489000000, "y" => $homes[0]['summonth6']),
    array("x" => 1341081000000, "y" => $homes[0]['summonth7']),
    array("x" => 1343759400000, "y" => $homes[0]['summonth8']),
    array("x" => 1346437800000, "y" => $homes[0]['summonth9']),
    array("x" => 1349116200000, "y" => $homes[0]['summonth10']),
    array("x" => 1351794600000, "y" => $homes[0]['summonth11']),
    array("x" => 1354473000000, "y" => $homes[0]['summonth12'])
    );
?>
 <script type="text/javascript">

$(function () {
    var chart = new CanvasJS.Chart("Areachart", {
        theme: "light2",
        animationEnabled: true,
        title: {
            text: "ภาพรวมรายจ่ายทั้งปี",
            fontSize: 25
        },
        axisX: {
            valueFormatString: "MMMM",
            interval: 1,
            intervalType: "month"

        },
        axisY: {
            title: "รายจ่าย"
        },

        data: [
        {
            type: "area",
            xValueType: "dateTime",
            dataPoints: <?php echo json_encode($dataPoints); ?>
        }
        ]
    });

    chart.render();
});
</script>
 <!-- ปิดสำหรับ Area Chart -->


 <!-- สำหรับ Piechart -->
 <?php
 $totalVisitors = $homes[0]['Allgen_value'];
 
$Alldata = array(
	array("y"=> $homes[0]['Sum_valueofeachtype1'], "name"=> "อื่นๆ", "color"=> "#ABDEE6"),
	array("y"=> $homes[0]['Sum_valueofeachtype2'], "name"=> "ค่าอบรม", "color"=> "#CBAACB"),
	array("y"=> $homes[0]['Sum_valueofeachtype3'], "name"=> "ค่าเช่า", "color"=> "#F6EAC2"),
	array("y"=> $homes[0]['Sum_valueofeachtype4'], "name"=> "อุปกรณ์สำนักงาน", "color"=> "#FFCCB6"),
	array("y"=> $homes[0]['Sum_valueofeachtype5'], "name"=> "เงินเดือน", "color"=> "#F3B0C3"),
	array("y"=> $homes[0]['Sum_valueofeachtype5'], "name"=> "ค่าขนส่ง", "color"=> "#9E293B"),
	array("y"=> $homes[0]['Sum_valueofeachtype5'], "name"=> "ค่า Survey", "color"=> "#2E2633"),
);
$Data1 = array(
	array("x"=> 1420050600000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_1']),
	array("x"=> 1422729000000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_2']),
	array("x"=> 1425148200000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_3']),
	array("x"=> 1427826600000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_4']),
	array("x"=> 1430418600000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_5']),
	array("x"=> 1433097000000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_6']),
	array("x"=> 1435689000000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_7']),
	array("x"=> 1438367400000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_8']),
	array("x"=> 1441045800000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_9']),
	array("x"=> 1443637800000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_10']),
	array("x"=> 1446316200000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_11']),
	array("x"=> 1448908200000 , "y"=> $homes[0]['Sum_valueofeachtype_month1_12'])
);
$Data2 = array(
	array("x"=> 1420050600000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_1']),
	array("x"=> 1422729000000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_2']),
	array("x"=> 1425148200000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_3']),
	array("x"=> 1427826600000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_4']),
	array("x"=> 1430418600000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_5']),
	array("x"=> 1433097000000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_6']),
	array("x"=> 1435689000000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_7']),
	array("x"=> 1438367400000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_8']),
	array("x"=> 1441045800000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_9']),
	array("x"=> 1443637800000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_10']),
	array("x"=> 1446316200000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_11']),
	array("x"=> 1448908200000 , "y"=> $homes[0]['Sum_valueofeachtype_month2_12'])
);
 
$Data3 = array(
	array("x"=> 1420050600000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_1']),
	array("x"=> 1422729000000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_2']),
	array("x"=> 1425148200000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_3']),
	array("x"=> 1427826600000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_4']),
	array("x"=> 1430418600000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_5']),
	array("x"=> 1433097000000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_6']),
	array("x"=> 1435689000000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_7']),
	array("x"=> 1438367400000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_8']),
	array("x"=> 1441045800000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_9']),
	array("x"=> 1443637800000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_10']),
	array("x"=> 1446316200000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_11']),
	array("x"=> 1448908200000 , "y"=> $homes[0]['Sum_valueofeachtype_month3_12'])
);
$Data4 = array(
	array("x"=> 1420050600000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_1']),
	array("x"=> 1422729000000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_2']),
	array("x"=> 1425148200000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_3']),
	array("x"=> 1427826600000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_4']),
	array("x"=> 1430418600000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_5']),
	array("x"=> 1433097000000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_6']),
	array("x"=> 1435689000000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_7']),
	array("x"=> 1438367400000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_8']),
	array("x"=> 1441045800000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_9']),
	array("x"=> 1443637800000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_10']),
	array("x"=> 1446316200000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_11']),
	array("x"=> 1448908200000 , "y"=> $homes[0]['Sum_valueofeachtype_month4_12'])
);
$Data5 = array(
	array("x"=> 1420050600000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_1']),
	array("x"=> 1422729000000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_2']),
	array("x"=> 1425148200000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_3']),
	array("x"=> 1427826600000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_4']),
	array("x"=> 1430418600000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_5']),
	array("x"=> 1433097000000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_6']),
	array("x"=> 1435689000000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_7']),
	array("x"=> 1438367400000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_8']),
	array("x"=> 1441045800000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_9']),
	array("x"=> 1443637800000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_10']),
	array("x"=> 1446316200000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_11']),
	array("x"=> 1448908200000 , "y"=> $homes[0]['Sum_valueofeachtype_month5_12'])
);
$Data6 = array(
	array("x"=> 1420050600000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_1']),
	array("x"=> 1422729000000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_2']),
	array("x"=> 1425148200000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_3']),
	array("x"=> 1427826600000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_4']),
	array("x"=> 1430418600000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_5']),
	array("x"=> 1433097000000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_6']),
	array("x"=> 1435689000000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_7']),
	array("x"=> 1438367400000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_8']),
	array("x"=> 1441045800000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_9']),
	array("x"=> 1443637800000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_10']),
	array("x"=> 1446316200000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_11']),
	array("x"=> 1448908200000 , "y"=> $homes[0]['Sum_valueofeachtype_month6_12'])
);
$Data7 = array(
	array("x"=> 1420050600000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_1']),
	array("x"=> 1422729000000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_2']),
	array("x"=> 1425148200000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_3']),
	array("x"=> 1427826600000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_4']),
	array("x"=> 1430418600000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_5']),
	array("x"=> 1433097000000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_6']),
	array("x"=> 1435689000000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_7']),
	array("x"=> 1438367400000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_8']),
	array("x"=> 1441045800000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_9']),
	array("x"=> 1443637800000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_10']),
	array("x"=> 1446316200000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_11']),
	array("x"=> 1448908200000 , "y"=> $homes[0]['Sum_valueofeachtype_month7_12'])
);
 ?>

<script>
window.onload = function () {
 
var totalVisitors = <?php echo $totalVisitors ?>;
var visitorsData = {
	"ฟังก์ชั่นแสดงกราฟ Pie": [{
		click: visitorsChartDrilldownHandler,
		cursor: "pointer",
		explodeOnClick: false,
		innerRadius: "75%",
		legendMarkerType: "square",
		name: "ฟังก์ชั่นแสดงกราฟ Pie",
		radius: "100%",
		showInLegend: true,
		startAngle: 90,
		type: "doughnut",
		dataPoints: <?php echo json_encode($Alldata, JSON_NUMERIC_CHECK); ?>
	}],
	"อื่นๆ": [{
		color: "#ABDEE6", // สีคอลัมน์ตอนกดเข้าไปข้างใน
		name: "อื่นๆ",
		type: "column",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($Data1, JSON_NUMERIC_CHECK); ?>
	}],	
    "ค่าอบรม": [{
		color: "#CBAACB", // สีคอลัมน์ตอนกดเข้าไปข้างใน
		name: "ค่าอบรม",
		type: "column",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($Data2, JSON_NUMERIC_CHECK); ?>
	}],
	"ค่าเช่า": [{
		color: "#F6EAC2", // สีคอลัมน์ตอนกดเข้าไปข้างใน
		name: "ค่าเช่า",
		type: "column",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($Data3, JSON_NUMERIC_CHECK); ?>
	}],
	"อุปกรณ์สำนักงาน": [{
		color: "#FFCCB6", // สีคอลัมน์ตอนกดเข้าไปข้างใน
		name: "อุปกรณ์สำนักงาน",
		type: "column",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($Data3, JSON_NUMERIC_CHECK); ?>
	}],
	"เงินเดือน": [{
		color: "#F3B0C3", // สีคอลัมน์ตอนกดเข้าไปข้างใน
		name: "เงินเดือน",
		type: "column",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($Data3, JSON_NUMERIC_CHECK); ?>
	}],
	"ค่าขนส่ง": [{
		color: "#9E293B", // สีคอลัมน์ตอนกดเข้าไปข้างใน
		name: "ค่าขนส่ง",
		type: "column",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($Data3, JSON_NUMERIC_CHECK); ?>
	}],
	"ค่า Survey": [{
		color: "#2E2633", // สีคอลัมน์ตอนกดเข้าไปข้างใน
		name: "ค่า Survey",
		type: "column",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($Data3, JSON_NUMERIC_CHECK); ?>
	}],
};
 
var newVSReturningVisitorsOptions = {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "ประเภทการเบิกจ่ายทั่วไป"
	},
	subtitles: [{
		text: "กดที่สีเพื่อดูรายละเอียด",
		backgroundColor: "#2eacd1",
		fontSize: 16,
		fontColor: "white",
		padding: 5
	}],
	legend: {
		fontFamily: "calibri",
		fontSize: 14,
		itemTextFormatter: function (e) {
			return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalVisitors * 100) + "%";  
		}
	},
	data: []
};
 
var visitorsDrilldownedChartOptions = {
	animationEnabled: true,
	theme: "light2",
	axisX: {
		labelFontColor: "#717171",
		lineColor: "#a2a2a2",
		tickColor: "#a2a2a2"
	},
	axisY: {
		gridThickness: 0,
		includeZero: false,
		labelFontColor: "#717171",
		lineColor: "#a2a2a2",
		tickColor: "#a2a2a2",
		lineThickness: 1
	},
	data: []
};
 
var chart = new CanvasJS.Chart("chartContainer", newVSReturningVisitorsOptions);
chart.options.data = visitorsData["ฟังก์ชั่นแสดงกราฟ Pie"];
chart.render();
 
function visitorsChartDrilldownHandler(e) {
	chart = new CanvasJS.Chart("chartContainer", visitorsDrilldownedChartOptions);
	chart.options.data = visitorsData[e.dataPoint.name];
	chart.options.title = { text: e.dataPoint.name }
	chart.render();
	$("#backButton").toggleClass("invisible");
}
 
$("#backButton").click(function() { 
	$(this).toggleClass("invisible");
	chart = new CanvasJS.Chart("chartContainer", newVSReturningVisitorsOptions);
	chart.options.data = visitorsData["ฟังก์ชั่นแสดงกราฟ Pie"];
	chart.render();
});
 
}
</script>
 <!-- สำหรับ Piechart -->