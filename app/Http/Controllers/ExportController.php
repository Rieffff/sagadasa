<?php

namespace App\Http\Controllers;


use App\Exports\DailyReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request; 
use App\Models\DailyReport;
use App\Models\Device;
use App\Models\DailyActivityDetail;
use App\Models\MaintenanceLog;
use App\Models\Contractor;
use App\Models\Company;
use App\Models\Location;
use App\Models\User;
use App\Models\MaintenanceLogAfter;
use App\Models\MaterialReplacement;
use App\Models\DailyActivity;
use App\Models\DailyProblem;
use App\Models\ManPower;
use App\Models\MaintenanceLogDetail;
use App\Models\MaintenanceItem;
use App\Models\MaintenanceLogAfterDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExportController extends Controller
{
    //
    public function exportDailyReports($id)
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

        $getReportNo = DB::table('daily_reports')->where('id', $id)->first();


        // Ambil bulan dari report_date
        $targetMonth = Carbon::parse($getReportNo->report_date)->format('Y-m');

        // Ambil semua laporan dalam bulan yang sama, urutkan berdasarkan report_date
        $thisReport = DB::table('daily_reports')
            ->whereRaw("DATE_FORMAT(report_date, '%Y-%m') = ?", [$targetMonth])
            ->orderBy('report_date', 'asc')
            ->pluck('id');
        $item = MaintenanceItem::all();

        // Cari posisi dari ID yang dikirim dalam daftar hasil query
        $indexNumber = $thisReport->search($id);
        // Hitung durasi dalam jam & menit
        $workStart = Carbon::parse($getReportNo->work_start);
        $workStop = Carbon::parse($getReportNo->work_stop);
        $diff = $workStart->diff($workStop);

        // Format hasil: "X jam Y menit"
        $totalHours = $diff->h; // Ambil jumlah jam
        $totalMinutes = $diff->i; // Ambil jumlah menit
        $dateToStr = date('dmY', strtotime( $report->report_date));
        $fileExportName = $dateToStr."".$indexNumber.".xlsx";   


        // Kemasan semua data ke dalam array sebelum dikirim ke Export Class
        $data = [
            'report'                     => $report,
            'item'                     => $item,
            'regularActivitiesActivity'   => $regularActivitiesActivity,
            'regularActivitiesRegular'    => $regularActivitiesRegular,
            'regularActivitiesNonregular' => $regularActivitiesNonregular,
            'maintenanceLogsActivity'     => $maintenanceLogsActivity,
            'maintenanceLogsRegular'      => $maintenanceLogsRegular,
            'maintenanceLogsNonregular'   => $maintenanceLogsNonregular,
            'maintenanceAfters'           => $maintenanceAfters,
            'indexNumber'                 => $indexNumber,
            'totalHours'                  => $totalHours,
            'totalMinutes'                => $totalMinutes
        ];

        return Excel::download(new DailyReportsExport($data), $fileExportName);


        // return Excel::download(new DailyReportsExport, 'daily_reports.xlsx');
    }
   
    public function exportDailyReports2($id)
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

        $getReportNo = DB::table('daily_reports')->where('id', $id)->first();


        // Ambil bulan dari report_date
        $targetMonth = Carbon::parse($getReportNo->report_date)->format('Y-m');

        // Ambil semua laporan dalam bulan yang sama, urutkan berdasarkan report_date
        $thisReport = DB::table('daily_reports')
            ->whereRaw("DATE_FORMAT(report_date, '%Y-%m') = ?", [$targetMonth])
            ->orderBy('report_date', 'asc')
            ->pluck('id');
            $item = MaintenanceItem::all();

        // Cari posisi dari ID yang dikirim dalam daftar hasil query
        $indexNumber = $thisReport->search($id);
        // Hitung durasi dalam jam & menit
        $workStart = Carbon::parse($getReportNo->work_start);
        $workStop = Carbon::parse($getReportNo->work_stop);
        $diff = $workStart->diff($workStop);

        // Format hasil: "X jam Y menit"
        $totalHours = $diff->h; // Ambil jumlah jam
        $totalMinutes = $diff->i; // Ambil jumlah menit


    
        // return response()->json($report);
        return view('reports.excel',compact(
            'report',
            'item',
            'regularActivitiesActivity',
            'regularActivitiesRegular',
            'regularActivitiesNonregular',
            'maintenanceLogsActivity',
            'maintenanceLogsRegular',
            'maintenanceAfters',
            'indexNumber',
            'totalHours',
            'totalMinutes',
            'maintenanceLogsNonregular'));
    }
   
}
