<?php

namespace App\Http\Controllers;

require(__DIR__ . '/../../../resources/deps/fpdf.php');

use App\Models\Reports;
use FPDF;

use Illuminate\Http\Request;

class Generator extends Controller
{
    public function generate(Request $request): void
    {
        $date = $request->input('reportrangefilter');
        list($start, $end) = explode(" to ", $date);

        // TODO: filter reports by start and end date
        $report = Reports::whereBetween('created_at', ["$start 00:00:00", "$end 23:59:59"])->get();

        $total = $report->count();
        $smallest = $report->min('est_size');
        $largest = $report->max('est_size');
        $average = $report->avg('est_size');

        $pdf = new PDFGenerator();
        $pdf->daterange = $date;
        date_default_timezone_set('Asia/Manila');
        $pdf->generated_at = date('l: F j, Y \a\t h:i:s A');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(40, 10, "Statistics");
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(8);
        $pdf->Cell(40, 10, "Total Fish Transferred: $total");
        $pdf->Ln(8);
        $pdf->Cell(40, 10, "Smallest Fish Transferred: $smallest");
        $pdf->Ln(8);
        $pdf->Cell(40, 10, "Biggest Fish Transferred: $largest");
        $pdf->Ln(8);
        $pdf->Cell(40, 10, "Average Fish Transferred: $average");
        $pdf->Output("D", "FISHERYNET_REPORT_". date("m.d.y") .".pdf");
    }
}

class PDFGenerator extends FPDF
{
    public $daterange = "";
    public $generated_at = "";
    // Page header
    public function Header(): void
    {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 10, 'FisheryNet Report', 0, 0, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Ln(1);
        $this->Cell(0, 20, "$this->daterange", 0, 0, 'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    public function Footer(): void
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'FisheryNet Report Generator | Generated at '. $this->generated_at .' | Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}
