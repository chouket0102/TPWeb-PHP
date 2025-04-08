<?php
require_once '../../isAuthentificated.php';
require_once '../../config/database.php';
require('../../libs/fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',15);
        $this->Cell(0,10,'Liste des Sections - '.date('d/m/Y'),0,1,'C');
        $this->Ln(10);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdo = getDBConnection();
$stmt = $pdo->query("SELECT * FROM sections");
$sections = $stmt->fetchAll();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);


$pdf->SetFillColor(200,220,255);
$pdf->Cell(20,10,'ID',1,0,'C',true);
$pdf->Cell(80,10,'Designation',1,0,'C',true);
$pdf->Cell(90,10,'Description',1,1,'C',true);


$fill = false;
foreach ($sections as $section) {
    $pdf->Cell(20,8,$section['id'],1,0,'C',$fill);
    $pdf->Cell(80,8,$section['designation'],1,0,'L',$fill);
    $pdf->Cell(90,8,$section['description'],1,1,'L',$fill);
    $fill = !$fill;
}

$pdf->Output('D','sections_'.date('Ymd').'.pdf');
exit;