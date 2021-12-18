<?php
//require_once "../modules/pdfMaker/vendor/tecnickcom/tcpdf/tcpdf.php";
//require_once "../modules/pdfMaker/vendor/tecnickcom/tcpdf/tcpdf.php";
class CustomPdfGenerator extends TCPDF
{
    public function Header()
    {
        $image_file = 'logo.png';
        $this->Image('logo.jpg', 500);
        $this->Image('logo.png', 10, 3, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 30);
        $this->SetTextColor(128, 0, 0);
      $this->Rect(0, 0, $this->getPageWidth(), $this->getPageHeight(), 
               'DF', "",  array(124, 235, 255)); 
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
       $this->SetFillColor(224, 235, 255);
        $this->Cell(0, 15, 'FlyBuy', 0, false, 'C', true, '', 0, false, 'M', 'M');
          
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 15);
        $this->Cell(0, 10, 'Thank you for your business!', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function printTable($header, $data)
    {
        $this->SetFillColor(0, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B', 12);

        $w = array(110, 17, 25, 30);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // table data
        $fill = 0;
        $total = 0;

        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
            $total += $row[3];
        }

        $this->Cell($w[0], 6, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[1], 6, '', 'LR', 0, 'R', $fill);
        $this->Cell($w[2], 6, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[3], 6, '', 'LR', 0, 'R', $fill);
        $this->Ln();

        $this->Cell($w[0], 6, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[1], 6, '', 'LR', 0, 'R', $fill);
        $this->Cell($w[2], 6, 'TOTAL:', 'LR', 0, 'L', $fill);
        $this->Cell($w[3], 6, $total, 'LR', 0, 'R', $fill);
        $this->Ln();

        $this->Cell(array_sum($w), 0, '', 'T');
    }
}
