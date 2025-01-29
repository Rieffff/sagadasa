<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DailyReport;

class ReportController extends Controller
{
    //
    public function generatePDF($id)
    {
        $report = DailyReport::with([
            'contractor',
            'company',
            'activities.device',
            'maintenanceLogs.maintenanceItem',
            'maintenanceLogs.maintenanceLogAfter',
            'manPowers',
        ])->findOrFail($id);

        $pdf = Pdf::loadView('reports.daily_report', compact('report'))->setPaper('a4', 'portrait');
        return $pdf->download("Daily_Report_.pdf");
    }
}
