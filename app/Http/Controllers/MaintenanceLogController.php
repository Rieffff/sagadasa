<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceLog;
use App\Http\Requests\StoreMaintenanceLogRequest;
use App\Http\Requests\UpdateMaintenanceLogRequest;

class MaintenanceLogController extends Controller
{
    public function index()
    {
        $logs = MaintenanceLog::with(['dailyReport', 'maintenanceItem'])->get();
        return response()->json($logs);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'report_id' => 'required|exists:daily_reports,id',
            'maintenance_item_id' => 'required|exists:maintenance_items,id',
            'status_before' => 'required|string',
            'status_after' => 'required|string',
        ]);

        $log = MaintenanceLog::create($data);

        return response()->json(['message' => 'Maintenance log created successfully', 'data' => $log]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'report_id' => 'sometimes|exists:daily_reports,id',
            'maintenance_item_id' => 'sometimes|exists:maintenance_items,id',
            'status_before' => 'sometimes|string',
            'status_after' => 'sometimes|string',
        ]);

        $log = MaintenanceLog::findOrFail($id);
        $log->update($data);

        return response()->json(['message' => 'Maintenance log updated successfully', 'data' => $log]);
    }

    public function destroy($id)
    {
        $log = MaintenanceLog::findOrFail($id);
        $log->delete();

        return response()->json(['message' => 'Maintenance log deleted successfully']);
    }
}
