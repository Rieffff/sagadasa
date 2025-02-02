<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DailyReport;
use App\Models\DailyActivityDetail;
use App\Models\MaintenanceLog;
use App\Models\MaintenanceLogAfter;
use App\Models\MaterialReplacement;
use App\Models\DailyActivity;
use App\Models\DailyProblem;
use App\Models\ManPower;
use App\Models\MaintenanceLogDetail;
use App\Models\MaintenanceItem;
use App\Models\MaintenanceLogAfterDetail;


class ReportController extends Controller
{
    //
    public function generatePDF($id)
    {
        $report = DailyReport::with([
            'contractor',
            'company',
            'activityDetails.device.location',
            'activityDetails.maintenanceLogs.maintenanceLogDetail',
            'activityDetails.maintenanceLogs.maintenanceAfter.maintenanceLogAfterDetail',
            'activityDetails.maintenanceLogs.maintenanceAfter.materialReplacements',
            'manPowers',
            'dailyActivities',
        ])->findOrFail($id);
        $regularActivitiesActivity = $report->activityDetails->where('status', 'activity');
        $regularActivitiesRegular = $report->activityDetails->where('status', 'regular');
        $regularActivitiesNonregular = $report->activityDetails->where('status', 'non-regular');

        $maintenanceLogsActivity = $regularActivitiesActivity->flatMap->maintenanceLogs;
        $maintenanceLogsRegular = $regularActivitiesRegular->flatMap->maintenanceLogs;
        $maintenanceLogsNonregular = $regularActivitiesNonregular->flatMap->maintenanceLogs;


        $maintenanceAfters = $maintenanceLogsRegular->flatMap->maintenanceAfter;


    
        return response()->json($report);
        // return view('reports.daily_report',compact(
        //     'report',
        //     'regularActivitiesActivity',
        //     'regularActivitiesRegular',
        //     'regularActivitiesNonregular',
        //     'maintenanceLogsActivity',
        //     'maintenanceLogsRegular',
        //     'maintenanceAfters',
        //     'maintenanceLogsNonregular'));

        // $pdf = Pdf::loadView('reports.daily_report', compact(
        //     'report',
        //     'regularActivitiesActivity',
        //     'regularActivitiesRegular',
        //     'regularActivitiesNonregular',
        //     'maintenanceLogsActivity',
        //     'maintenanceLogsRegular',
        //     'maintenanceAfters',
        //     'maintenanceLogsNonregular'))
        //     ->setPaper('a4', 'portrait')
        //     ->setOptions([
        //         'enable-local-file-access' => true, 
        //         'disable-smart-shrinking' => true,
        //     ]);
        // return $pdf->download("Dom_Report_{$report->report_date}.pdf");
    
    }

    public function generatePDF2($id)
    {
        $report = DailyReport::with([
            'contractor',
            'company',
            'activityDetails.device.location',
            'activityDetails.maintenanceLogs.maintenanceLogDetail',
            'activityDetails.maintenanceLogs.maintenanceAfter.maintenanceLogAfterDetail',
            'activityDetails.maintenanceLogs.maintenanceAfter.materialReplacements',
            'manPowers',
            'dailyActivities',
        ])->findOrFail($id);
        $regularActivitiesActivity = $report->activityDetails->where('status', 'activity');
        $regularActivitiesRegular = $report->activityDetails->where('status', 'regular');
        $regularActivitiesNonregular = $report->activityDetails->where('status', 'non-regular');

        $maintenanceLogsActivity = $regularActivitiesActivity->flatMap->maintenanceLogs;
        $maintenanceLogsRegular = $regularActivitiesRegular->flatMap->maintenanceLogs;
        $maintenanceLogsNonregular = $regularActivitiesNonregular->flatMap->maintenanceLogs;


        $maintenanceAfters = $maintenanceLogsRegular->flatMap->maintenanceAfter;


    
        // return response()->json($report);
        return view('reports.daily_report2',compact(
            'report',
            'regularActivitiesActivity',
            'regularActivitiesRegular',
            'regularActivitiesNonregular',
            'maintenanceLogsActivity',
            'maintenanceLogsRegular',
            'maintenanceAfters',
            'maintenanceLogsNonregular'));
        // $pdf = Pdf::loadView('reports.daily_report', compact('report'))->setPaper('a4', 'portrait');
        // return $pdf->download("Daily_Report_.pdf");
    }

    public function daily(){
        $data = DailyReport::with([
            'contractor',
            'company',
            'activityDetails.device.location',
            'activityDetails.maintenanceLogs.maintenanceLogDetail',
            'activityDetails.maintenanceLogs.maintenanceAfter.maintenanceLogAfterDetail',
            'activityDetails.maintenanceLogs.maintenanceAfter.materialReplacements',
            'manPowers',
            'dailyActivities',
        ])->get();

        return view('report',compact('data'));
        // return response()->json($data);
    }
    
}
