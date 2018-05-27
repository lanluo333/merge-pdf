<?php

require_once('fpdf/fpdf.php');
require_once('FPDI/fpdi.php');


$files = array(
    'a.pdf',
    'b.pdf',
);

// initiate FPDI
$pdf = new FPDI();

// iterate through the files
foreach ($files AS $file) {
    // get the page count
    $pageCount = $pdf->setSourceFile($file);
    // iterate through all pages
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        // import a page
        $templateId = $pdf->importPage($pageNo);
        // get the size of the imported page
        $size = $pdf->getTemplateSize($templateId);

        // create a page (landscape or portrait depending on the imported page size)
        if ($size['w'] > $size['h']) {
            $pdf->AddPage('L', array($size['w'], $size['h']));
        } else {
            $pdf->AddPage('P', array($size['w'], $size['h']));
        }

        // use the imported page
        $pdf->useTemplate($templateId);

        $pdf->SetFont('Helvetica');
        $pdf->SetXY(5, 5);
        $pdf->Write(8, 'A simple concatenation demo with FPDI');
    }
}

// Output the new PDF
$pdf->Output();



