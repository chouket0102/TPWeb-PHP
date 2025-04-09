<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once '../../isAuthentificated.php';
require_once '../../config/database.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

try {
   
    $pdo = getDBConnection();
    
 
    $stmt = $pdo->query("
        SELECT s.id, s.name, s.birthday, s.image, s.section_id, 
               sec.designation as section_name
        FROM students s
        LEFT JOIN sections sec ON s.section_id = sec.id
        ORDER BY s.id
    ");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($students)) {
        throw new Exception("No data found in students table.");
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    // Title
    $sheet->setTitle('Students List');

    // columns
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Name');
    $sheet->setCellValue('C1', 'Date of Birth');
    $sheet->setCellValue('D1', 'Section ID');
    $sheet->setCellValue('E1', 'Section');

    // Style for the header row
    $headerStyle = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => '4472C4'],
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];
    
    $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);
    
    
    foreach(range('A', 'E') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    
    $row = 2;
    foreach ($students as $student) {
        
        $birthDate = date('d/m/Y', strtotime($student['birthday']));
        
        $sheet->setCellValue('A' . $row, $student['id']);
        $sheet->setCellValue('B' . $row, $student['name']);
        $sheet->setCellValue('C' . $row, $birthDate);
        $sheet->setCellValue('D' . $row, $student['section_id'] ?? 'N/A');
        $sheet->setCellValue('E' . $row, $student['section_name'] ?? 'N/A');
        
        // Apply zebra striping for better readability
        if ($row % 2 == 0) {
            $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E9EFF7'],
                ],
            ]);
        }
        
        $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
        
        $row++;
    }

    
    $fileName = 'students_export_' . date('Y-m-d') . '.xlsx';

    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');

    
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

} catch (Exception $e) {
    if (ob_get_length()) ob_clean();
    die('Error: ' . $e->getMessage());
}