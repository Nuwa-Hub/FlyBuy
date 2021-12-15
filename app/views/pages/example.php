<?php
require "../modules/ppdfMaker/vendor/autoload.php";
require "../modules/ppdfMaker/customPdfGenerator.php";

$pdf = new CustomPdfGenerator(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setFontSubsetting(true);
$pdf->SetFont('dejavusans', '', 12, '', true);

// start a new page
$pdf->AddPage();
$pdf->writeHTML('
<img src="logo.png" width=10px hieght=10px>
');
// date and invoice no
$pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTML("<b>DATE:</b> 01/01/2021");
$pdf->writeHTML("<b>INVOICE#</b>12");
$pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

// address
$pdf->writeHTML("84 Norton Street,");
$pdf->writeHTML("NORMANHURST,");
$pdf->writeHTML("New South Wales, 2076");
$pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

// bill to
$pdf->writeHTML("<b>BILL TO:</b>", true, false, false, false, 'R');
$pdf->writeHTML("22 South Molle Boulevard,", true, false, false, false, 'R');
$pdf->writeHTML("KOOROOMOOL,", true, false, false, false, 'R');
$pdf->writeHTML("Queensland, 4854", true, false, false, false, 'R');
$pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

// invoice table starts here
$header = array('DESCRIPTION', 'UNITS', 'RATE $', 'AMOUNT');
$data = array(
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
     array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
   array('Item #1', '1', '100', '100'),
  
   array('Item #2', '2', '200', '400')

);
$pdf->printTable($header, $data);
$pdf->Ln();

// comments
$pdf->SetFont('', '', 12);
$pdf->writeHTML("<b>OTHER COMMENTS:</b>");
$pdf->writeHTML("Method of payment: <i>PAYPAL</i>");
$pdf->writeHTML("PayPal ID: <i>katie@paypal.com");
$pdf->Write(0, "\n\n\n", '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTML("If you have any questions about this invoice, please contact:", true, false, false, false, 'C');
$pdf->writeHTML("Katie A Falk, (07) 4050 2235, katie@sks.com", true, false, false, false, 'C');

// save pdf file
$pdf->Output(__DIR__ . '/invoice#13.pdf', 'I');

