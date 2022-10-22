<?php
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php"; // forserver
// require $_SERVER['DOCUMENT_ROOT'] . "/swstimemanagement/vendor/autoload.php"; // local

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'ลำดับ');
$sheet->setCellValue('B1', 'ชื่อพนักงาน');
$sheet->setCellValue('C1', 'ตำแหน่ง');
$sheet->setCellValue('D1', 'แผนก');
$sheet->setCellValue('E1', 'วันที่');
$sheet->setCellValue('F1', 'เดือน');
$sheet->setCellValue('G1', 'ปี');
$sheet->setCellValue('H1', 'ลงชื่อเช้า');
$sheet->setCellValue('I1', 'ลงชื่อเที่ยง');
$sheet->setCellValue('J1', 'ลงชื่อเย็น');
$sheet->setCellValue('K1', 'สรุปงาน');

$i = 2;
foreach ($reviews as $row) {
    $no = $row['no'];
    $Person_name = $row['Person_name'] . ' ' . $row['Person_sname'] . ' (' . $row['Person_niname'] . ')';
    $Position = $row['Position'];
    $Department = $row['Department'];
    $Day = $row['Day'];
    $Month = $row['Month'];
    $Year = $row['Year'];
    $Time_loginm = $row['Time_loginm'];
    $Time_logina = $row['Time_logina'];
    $Time_logout = $row['Time_logout'];
    $Time_logout_reason = $row['Time_logout_reason'];

    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $Person_name);
    $sheet->setCellValue('C' . $i, $Position);
    $sheet->setCellValue('D' . $i, $Department);
    $sheet->setCellValue('E' . $i, $Day);
    $sheet->setCellValue('F' . $i, $Month);
    $sheet->setCellValue('G' . $i, $Year);
    $sheet->setCellValue('H' . $i, $Time_loginm);
    $sheet->setCellValue('I' . $i, $Time_logina);
    $sheet->setCellValue('J' . $i, $Time_logout);
    $sheet->setCellValue('K' . $i, $Time_logout_reason);
    $i++;
}

date_default_timezone_set("Asia/Bangkok");
$datetime = new DateTime();
$datenow = $datetime->format('Y-m-d');
$timenow = $datetime->format('H-i-s');

$writer = new Xlsx($spreadsheet);

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=เดือน {$Monthpick} โหลดไฟล์วันที่ {$datenow} เวลา {$timenow}.xlsx");
header('Cache-Control: max-age=0');
$writer->save('php://output');
