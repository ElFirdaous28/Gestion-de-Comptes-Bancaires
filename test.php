<?php
// Include the Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('John Doe');
$pdf->SetTitle('Sample PDF');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add some content
$pdf->Write(0, 'Hello, TCPDF!');

// Output PDF
$pdf->Output('sample.pdf', 'I');
?>
