<?php
require_once '../../isAuthentificated.php';
require_once '../../config/database.php';

$pdo = getDBConnection();
$stmt = $pdo->query("SELECT * FROM sections");
$sections = $stmt->fetchAll();

// Créer le fichier CSV
$filename = 'sections_export_'.date('Y-m-d').'.csv';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.$filename.'"');

$output = fopen('php://output', 'w');


fputcsv($output, ['ID', 'Designation', 'Description']);


foreach ($sections as $section) {
    fputcsv($output, [
        $section['id'],
        $section['designation'],
        $section['description']
    ]);
}

fclose($output);
exit;