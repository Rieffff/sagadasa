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
use App\Http\Requests\StoreMaintenanceLogRequest;
use App\Http\Requests\UpdateMaintenanceLogRequest;

class MaintenanceLogController extends Controller
{
    public function index($id)
    {
        // $logs = MaintenanceLog::where;
        $detail_id = $id;
        $item = MaintenanceItem::all();
        $data = DailyActivityDetail::with([
            'maintenanceLogs.maintenanceLogDetail',
            'maintenanceLogs.maintenanceAfter.maintenanceLogAfterDetail',
            'maintenanceLogs.maintenanceAfter.materialReplacements',
        ])->findOrFail($id);
        return view('maintenance.index',compact(['detail_id','item','data']));
        
    }
    public function getData($id)
    {
        $data = DailyActivityDetail::with([
            'maintenanceLogs.maintenanceLogDetail',
            'maintenanceLogs.maintenanceAfter.maintenanceLogAfterDetail',
            'maintenanceLogs.maintenanceAfter.materialReplacements',
        ])->findOrFail($id);
        
        return response()->json(['data' => $data]);
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
