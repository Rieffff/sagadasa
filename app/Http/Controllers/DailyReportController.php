<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use App\Http\Requests\StoreDailyReportRequest;
use App\Http\Requests\UpdateDailyReportRequest;

class DailyReportController extends Controller
{
    public function index()
    {
        $reports = DailyReport::with(['contractor', 'company', 'device', 'technician'])->get();
        return response()->json($reports);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'report_date' => 'required|date',
            'contractor_id' => 'required|exists:contractors,id',
            'company_id' => 'required|exists:companies,id',
            'device_id' => 'required|exists:devices,id',
            'technician_id' => 'required|exists:technicians,id',
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
            'technician_id' => 'sometimes|exists:technicians,id',
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
}
