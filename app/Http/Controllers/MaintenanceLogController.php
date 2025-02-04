<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DailyReport;
use App\Models\Device;
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

    public function create(){
        $maintenance_items = MaintenanceItem::all();
        $device = Device::all();
        return view('maintenance.form',compact('maintenance_items','device'));
    }
    public function store2(Request $request)
    {
        $request->validate([
            'log_date' => 'required|date',
            'description' => 'required|string',
            'maintenance_item_id' => 'required|array',
            'status' => 'required|array',
            'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'after_description' => 'nullable|string',
            'item_name' => 'nullable|array',
            'replacement_status' => 'nullable|array'
        ]);

        // Simpan Maintenance Log
        $log = MaintenanceLog::create([
            'log_date' => $request->log_date,
            'description' => $request->description
        ]);

        // Simpan Maintenance Log Details
        foreach ($request->maintenance_item_id as $index => $item_id) {
            MaintenanceLogDetail::create([
                'maintenance_log_id' => $log->id,
                'maintenance_item_id' => $item_id,
                'status' => $request->status[$index]
            ]);
        }

        // Simpan Maintenance Log After
        $logAfter = MaintenanceLogAfter::create([
            'maintenance_log_id' => $log->id,
            'description' => $request->after_description
        ]);

        // Simpan Foto Jika Ada
        if ($request->hasFile('photos')) {
            $path = $request->file('photos')->store('maintenance_photos', 'public');
            $logAfter->update(['photos' => $path]);
        }

        // Simpan Maintenance Log After Details
        if (!empty($request->item_name)) {
            foreach ($request->item_name as $index => $name) {
                MaintenanceLogAfterDetail::create([
                    'maintenance_log_after_id' => $logAfter->id,
                    'item_name' => $name,
                    'status' => $request->replacement_status[$index]
                ]);
            }
        }

        return redirect()->back()->with('success', 'Maintenance log has been saved successfully.');
    }
}
