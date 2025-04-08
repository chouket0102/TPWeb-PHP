<?php
require_once '../../config/database.php';

$pdo = getDBConnection();


$stmt = $pdo->query("
    SELECT s.id, s.name, s.birthday, s.image, s.section_id, sec.designation as section_name 
    FROM students s
    LEFT JOIN sections sec ON s.section_id = sec.id
    ORDER BY s.id
");
$students = $stmt->fetchAll();


$filename = 'etudiants_export_'.date('Y-m-d').'.csv';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.$filename.'"');

$output = fopen('php://output', 'w');


fputcsv($output, ['ID', 'Nom', 'Date de naissance', 'ID Section', 'Section']);


foreach ($students as $student) {
    
    $birthDate = date('d/m/Y', strtotime($student['birthday']));
    
    fputcsv($output, [
        $student['id'],
        $student['name'],
        $birthDate,
        $student['section_id'],
        $student['section_name']
    ]);
}

fclose($output);
exit;