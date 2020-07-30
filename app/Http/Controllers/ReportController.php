<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Services\ReportService;

class ReportController extends Controller
{
    private $reportService;

    public function __construct(ReportService $reportService) {
        $this->reportService = $reportService;
    }

    public function dataReport() {
        $dosages = $this->reportService->findAll();

        return PDF::loadView('report.report-data', compact('dosages'))
            ->setPaper('a4', 'landscape')
            ->stream('relatório.pdf');
    }

}
