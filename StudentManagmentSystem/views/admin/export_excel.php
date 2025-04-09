<?php
require_once '../../isAuthentificated.php';
require_once '../../config/database.php';


require_once '../../libs/PhpSpreadsheet/src/PhpOffice/PhpSpreadsheet/Writer/IWriter.php';
require_once '../../libs/PhpSpreadsheet/src/PhpOffice/PhpSpreadsheet/Writer/BaseWriter.php';
require_once '../../libs/PhpSpreadsheet/src/PhpOffice/PhpSpreadsheet/Spreadsheet.php';
require_once '../../libs/PhpSpreadsheet/src/PhpOffice/PhpSpreadsheet/Writer/Xlsx.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$pdo = getDBConnection();
$stmt = $pdo->query("SELECT * FROM sections");
$sections = $stmt->fetchAll();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Designation');
$sheet->setCellValue('C1', 'Description');


$row = 2;
foreach ($sections as $section) {
    $sheet->setCellValue('A'.$row, $section['id']);
    $sheet->setCellValue('B'.$row, $section['designation']);
    $sheet->setCellValue('C'.$row, $section['description']);
    $row++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="sections_export.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;