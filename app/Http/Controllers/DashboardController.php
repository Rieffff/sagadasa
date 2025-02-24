<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyReport;
use Illuminate\Support\Facades\Auth;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function index(){

        $startDate = Carbon::now()->subMonths(3)->startOfMonth(); // 3 bulan lalu dari bulan ini
        $endDate = Carbon::now()->endOfMonth(); // Akhir bulan sekarang
        
        // Ambil data laporan harian, dikelompokkan berdasarkan bulan
        $monthlyReports = DailyReport::select(
                DB::raw("DATE_FORMAT(report_date, '%Y-%m') as month"), 
                DB::raw('COUNT(id) as total_reports')
            )
            ->whereBetween('report_date', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('total_reports', 'month'); // Menghasilkan koleksi dengan key bulan dan value total laporan
        
        // Buat array kosong untuk memastikan semua bulan tetap ada
        $data = [];
        $dbMonth = [];
        
        // Loop untuk 4 bulan terakhir
        for ($i = 3; $i >= 0; $i--) {
            $monthKey = Carbon::now()->subMonths($i)->format('Y-m'); // Format bulan (YYYY-MM)
            $formattedMonth = Carbon::now()->subMonths($i)->format('M Y'); // Format untuk tampilan ('Nov 2023')
    
            $dbMonth[] = $formattedMonth; 
            $data[] = $monthlyReports[$monthKey] ?? 0; // Jika tidak ada data, set 0
        }
        // chart 2
        // Ambil jumlah status OK & ERROR, dikelompokkan berdasarkan lokasi

        // Ambil semua data
    $latestReports = DB::table('daily_activity_details')
        ->join('daily_reports', 'daily_activity_details.report_id', '=', 'daily_reports.id') 
        ->select('daily_activity_details.device_id', DB::raw('MAX(daily_reports.report_date) as latest_report_date'))
        ->groupBy('daily_activity_details.device_id'); // Ambil tanggal terbaru per device_id

    $reportStatus = DB::table('daily_activity_details')
        ->join('daily_reports', 'daily_activity_details.report_id', '=', 'daily_reports.id')
        ->joinSub($latestReports, 'latest_reports', function ($join) {
            $join->on('daily_activity_details.device_id', '=', 'latest_reports.device_id')
                ->on('daily_reports.report_date', '=', 'latest_reports.latest_report_date');
        })
        ->leftJoin('devices', 'devices.id', '=', 'daily_activity_details.device_id')
        ->join('maintenance_logs', 'daily_activity_details.id', '=', 'maintenance_logs.report_detail_id')
        ->join('maintenance_log_afters', 'maintenance_logs.id', '=', 'maintenance_log_afters.maintenance_log_id')
        ->join('maintenance_log_after_details', 'maintenance_log_afters.id', '=', 'maintenance_log_after_details.maintenance_log_after_id')
        ->select(
            'daily_activity_details.device_id',
            'devices.device_name',
            DB::raw("SUM(CASE WHEN maintenance_log_after_details.status = 'OK' THEN 1 ELSE 0 END) as totalOk"),
            DB::raw("SUM(CASE WHEN maintenance_log_after_details.status = 'ERROR' THEN 1 ELSE 0 END) as totalError")
        )
        ->where('daily_activity_details.status', 'regular')
        ->groupBy('daily_activity_details.device_id', 'devices.device_name')
        ->get();

        // Inisialisasi array untuk hasil
        $deviceData = [];

        // Grouping berdasarkan device_id
        // dd($reportStatus);
        // if ($reportStatus->isEmpty()) {
        //     abort(404, 'Data tidak ditemukan.');
        // }
        if ($reportStatus->count() > 0) {
            # code...
            foreach ($reportStatus as $row) {
                $deviceName[] = $row->device_name;
                $totalOk[] = $row->totalOk;
                $totalError[] = $row->totalError;
            }
        }else{
            $deviceName = 'NULL' ;
            $totalOk = 0;
            $totalError = 0;
            
        }
        // Konversi hasil ke array untuk Blade
        // dd($totalError);
        // $deviceNames = array_column($deviceData, 'deviceName');
        // $totalOk = array_column($deviceData, 'totalOk');
        // $totalError = array_column($deviceData, 'totalError');
        $sum = 0;
        for($i = 0; $i < count($data); $i++){
            $sum += $data[$i];
        }

        $device = Device::all()->count();
        $location = Location::all()->count();
        $user = User::where('position','Technician')->count();
        $rowReport = DailyReport::all()->count();
        $sesUser = Auth::User()->name;

        $company = Company::all();
        $contractor = Contractor::all();
        $company = $company->isEmpty() ? [['id' => 0, 'company_name' => 'No Data Available !!', 'address' => 'No Data Available !!','contact' => 'No Data Available !!','logo' => 'No Data Available !!']] : $company;
        $contractor = $contractor->isEmpty() ? [['id' => 0, 'contractor_name' => 'No Data Available !!', 'address' => 'No Data Available !!','contact_information' => 'No Data Available !!','logo' => 'No Data Available !!']] : $contractor;

        // dd($user);



        return view('blank', compact('contractor','company','rowReport','sesUser','data', 'dbMonth','deviceName', 'totalOk', 'totalError','sum','device','user','location'));

    }
}
