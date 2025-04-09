<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once '../../isAuthentificated.php';
require_once '../../config/database.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

try {
    
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT * FROM sections");
    $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($sections)) {
        throw new Exception("No data found in sections table.");
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Designation');
    $sheet->setCellValue('C1', 'Description');

   
    $row = 2;
    foreach ($sections as $section) {
        $sheet->setCellValue('A'.$row, $section['id']);
        $sheet->setCellValue('B'.$row, $section['designation']); // Fix typo if needed
        $sheet->setCellValue('C'.$row, $section['description']);
        $row++;
    }

    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="sections_export.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

} catch (Exception $e) {
    if (ob_get_length()) ob_clean();
    die('Error: ' . $e->getMessage());
}