<?php
require_once '../../config/database.php';
require('../../libs/fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',15);
        $this->Cell(0,10,'Liste des Etudiants - '.date('d/m/Y'),0,1,'C');
        $this->Ln(10);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdo = getDBConnection();


$stmt = $pdo->query("
    SELECT s.id, s.name, s.birthday, s.image, s.section_id, sec.designation as section_name 
    FROM students s
    LEFT JOIN sections sec ON s.section_id = sec.id
    ORDER BY s.id
");
$students = $stmt->fetchAll();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);


$pdf->SetFillColor(200,220,255);
$pdf->Cell(15,10,'ID',1,0,'C',true);
$pdf->Cell(60,10,'Nom',1,0,'C',true);
$pdf->Cell(30,10,'Date de naissance',1,0,'C',true);
$pdf->Cell(85,10,'Section',1,1,'C',true);


$fill = false;
foreach ($students as $student) {
    
    $birthDate = date('d/m/Y', strtotime($student['birthday']));
    
    $pdf->Cell(15,8,$student['id'],1,0,'C',$fill);
    $pdf->Cell(60,8,$student['name'],1,0,'L',$fill);
    $pdf->Cell(30,8,$birthDate,1,0,'C',$fill);
    $pdf->Cell(85,8,$student['section_name'],1,1,'L',$fill);
    $fill = !$fill;
}

$pdf->Output('D','etudiants_'.date('Ymd').'.pdf');
exit;