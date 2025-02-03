<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use App\Models\MaintenanceLog;
use Illuminate\Http\Request;
use App\Models\Contractor;
use App\Models\Company;
use App\Models\Location;
use App\Models\Device;
use App\Models\User;
use App\Models\MaintenanceItem;
use App\Http\Requests\StoreDailyReportRequest;
use App\Http\Requests\UpdateDailyReportRequest;

class DailyReportController extends Controller
{
    public function index()
    {
        $contractors = Contractor::all();
        $companies = Company::all();
        $locations = Location::all();
        return view('daily_reports.index', compact('contractors', 'companies','locations'));
    }

    public function getData()
    {
        $data = DailyReport::with(['contractor', 'company'])->get();
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'report_date' => 'required|date',
            'work_start' => 'required',
            'work_stop' => 'required',
            'work_break' => 'required',
            'service_data' => 'required',
            'work_reason' => 'required',
            'location' => 'required',
            'detail_activity' => 'required',
            'po' => 'required',
            'approved_by' => 'required',
            'contractor_id' => 'required|exists:contractors,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        DailyReport::create($request->all());

        return response()->json(['message' => 'Daily Report berhasil ditambahkan']);
    }

    public function show($id)
    {
        $report = DailyReport::with(['dailyActivities', 'dailyActivityDetails', 'manPowers'])->findOrFail($id);
        return view('daily_reports.show', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'report_date' => 'sometimes|date',
            'contractor_id' => 'sometimes|exists:contractors,id',
            'company_id' => 'sometimes|exists:companies,id',
            'device_id' => 'sometimes|exists:devices,id',
            'user_id' => 'sometimes|exists:technicians,id',
            'activity_details' => 'sometimes|string',
            'status' => 'sometimes|string',
        ]);

        $report = DailyReport::findOrFail($id);
        $report->update($data);

        return response()->json(['message' => 'Daily report updated successfully', 'data' => $report]);
    }

    public function destroy($id)
    {
        $report = DailyReport::findOrFail($id);
        $report->delete();

        return response()->json(['message' => 'Daily report deleted successfully']);
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'report_date' => 'required|date',
            'contractor_id' => 'required|exists:contractors,id',
            'user_id' => 'required|exists:technicians,id',
            'activity_details' => 'required|string',
            'status' => 'required|in:reguler,non-reguler',
            'activities' => 'required|array',
            'activities.*.maintenance_item_id' => 'required|exists:maintenance_items,id',
            'activities.*.status_before' => 'required|string',
            'activities.*.status_after' => 'required|string',
        ]);

        $dailyReport = DailyReport::create($request->only('report_date', 'contractor_id', 'user_id', 'activity_details', 'status'));

        foreach ($request->activities as $activity) {
            $dailyReport->maintenanceLogs()->create($activity);
        }

        return response()->json(['message' => 'Laporan berhasil disimpan']);
    }

    public function create()
    {
        // Ambil data kontraktor, teknisi, dan item maintenance dari database
        $contractors = Contractor::all();
        $technicians = User::where('position','=','Technician')->get();
        $maintenanceItems = MaintenanceItem::all();
        $devices = Device::all();
        $companies = Company::all();
        $locations = Location::all();

        // Kirim data ke view
        return view('daily-report.index', compact('contractors', 'technicians', 'maintenanceItems','devices','companies', 'locations'));
    }

    public function getDevices($id){
        $device = Device::where('id_location','=',$id)->get();

        return response()->json(['data' => $device]);
    }
}
