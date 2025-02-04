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
use Illuminate\Support\Facades\DB;

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

    public function create($id){
        $maintenance_items = MaintenanceItem::all();
        $device = Device::all();
        $detail_id = $id;
        return view('maintenance.form',compact('maintenance_items','device','detail_id'));
    }
    public function store2(Request $request)
    {
        $request->validate([
            'detail_id' => 'required|exists:daily_activity_details,id',
            'photos' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'after_log_description' => 'nullable|string',
            'after_photos' => 'nullable|image|max:2048',
        ]);

        try {

            // dump($request->material_description[0]);
            DB::beginTransaction();

            // 1️⃣ Simpan foto pertama (sebelum perbaikan)
            
            if ($request->hasFile('photos')) {
                $file = $request->file('photos');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/reportImg', $fileName); // Simpan ke storage
                $photos = $fileName; // Simpan path yang bisa diakses
            }
            // echo $fileName;

            // 2️⃣ Simpan data ke maintenance_logs
            $maintenanceLog = MaintenanceLog::create([
                'report_detail_id' => $request->detail_id,
                'photos' => $photos,
                'description' => $request->description,
            ]);
            
            // 3️⃣ Simpan data ke maintenance_log_details
            $pe = 0;
            if ($request->has('maintenance_item_id')) {
                foreach ($request->maintenance_item_id as $item) {
                    
                    $logDetail = MaintenanceLogDetail::create([
                        'maintenance_log_id' => $maintenanceLog->id,
                        'maintenance_item_id' => $item,
                        'status' => $request->status[$pe],
                    ]);
                    

                    $pe++;
                }
            }

            // 4️⃣ Simpan foto kedua (setelah perbaikan)
            if ($request->hasFile('after_photos')) {
                $file2 = $request->file('after_photos');
                $fileName2 = time() . '_after_' . $file2->getClientOriginalName();
                $filePath2 = $file2->storeAs('public/reportImg', $fileName2); // Simpan ke storage
                $photos2 = $fileName2; // Simpan path yang bisa diakses
            }

            // 5️⃣ Simpan data ke maintenance_log_afters
            $maintenanceLogAfter = MaintenanceLogAfter::create([
                'maintenance_log_id' => $maintenanceLog->id,
                'description' => $request->after_description ?? null,
                'photos' => $photos2,
            ]);

            // 6️⃣ Simpan data ke maintenance_log_after_details
            $pee = 0;
            if ($request->has('item_name')) {
                foreach ($request->item_name as $item) {
                    $logAfterDetail = MaintenanceLogAfterDetail::create([
                        'maintenance_log_after_id' => $maintenanceLogAfter->id,
                        'item_name' => $item,
                        'status' => $request->status_after[$pee],
                    ]);
                    $pee++;
                }
            }

            // 7️⃣ Simpan data ke material_replacements
            $peee = 0;
            if ($request->has('material_name')) {
                foreach ($request->material_name as $material) {
                    $material = MaterialReplacement::create([
                        'maintenance_log_after_id' => $maintenanceLogAfter->id,
                        'material_name' => $material,
                        'quantity' => "1",
                        'description' => $request->material_description[$peee] ?? null,
                    ]);
                    $peee++;
                }
            }

            DB::commit();
            
            return redirect()->route('log', [$request->detail_id]);
            // // return response()->json(['message' => 'Maintenance Log successfully added!'], 201);
            // return redirect()->back();
            echo "<br>PEEEE<br>";
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            // return redirect()->back()->with('message' , );   
            // return response()->json(['error' => 'Failed to save maintenance log', 'message' => $e->getMessage()], 500);
        }
        dd($request);
    }
}
