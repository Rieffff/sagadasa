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
        $reports = DailyReport::with(['contractor', 'company', 'device', 'user'])->get();
        return response()->json($reports);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'report_date' => 'required|date',
            'contractor_id' => 'required|exists:contractors,id',
            'company_id' => 'required|exists:companies,id',
            'device_id' => 'required|exists:devices,id',
            'user_id' => 'required|exists:technicians,id',
            'activity_details' => 'required|string',
            'status' => 'required|string',
        ]);

        $report = DailyReport::create($data);
        return response()->json(['message' => 'Daily report created successfully', 'data' => $report]);
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
        $technicians = User::all();
        $maintenanceItems = MaintenanceItem::all();
        $devices = Device::all();
        $companies = Company::all();
        $locations = Location::all();

        // Kirim data ke view
        return view('daily-report.index', compact('contractors', 'technicians', 'maintenanceItems','devices','companies', 'locations'));
    }
}
