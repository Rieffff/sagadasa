<?php

namespace App\Http\Controllers;

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
use App\Http\Requests\StoreMaintenanceLogRequest;
use App\Http\Requests\UpdateMaintenanceLogRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Helpers\ImageHelper;

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
    public function uploadFoto($foto){
        if ($foto->hasFile('photo')) {
            $image = $foto->file('photo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Resize dan Compress
            $resizedImage = Image::make($image)
                ->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('jpg', 75); // Ubah ke JPG dengan kualitas 75%

            // Simpan ke storage
            Storage::disk('public')->put('public/reportImg' . $filename, $resizedImage);
        }
        return $filename;
    }
    public function store2(Request $request)
    {
        // dd($request);

        // dump($request);
        try {
            
            DB::beginTransaction();
            $location = Location::findOrFail($request->location);

            $daily_reports = DailyReport::create([
            'report_date' => $request->report_date,
            'work_start' => $request->work_start,
            'work_stop' => $request->work_stop,
            'work_break' => $request->work_break,
            'service_data' => $request->service_data,
            'work_reason' => $request->work_reason,
            'location' => $location->location_name,
            'detail_activity' => $request->detail_activity,
            'po' => "Yes",
            'approved_by' => $request->approved_by,
            'contractor_id' => $request->contactor,
            'company_id' => $request->company
            ]);

            if ($request->has('status')) {
                $pe = 0;
                foreach ($request->status as $row) {
                    
                    $dbUser = User::findOrFail($request->man_powers[$pe]);
                    $foto[$pe] = ImageHelper::uploadAndResize($request->photosActivity[$pe],$pe,"activity");

                    // dd($request->deviceReguler);
                    $daily_activity_details = DailyActivityDetail::create([
                        'device_id' => $request->deviceReguler[0],
                        'report_id' => $daily_reports->id,
                        'activity_description' => $request->activity_description[0],
                        'status' => $row
                    ]);

                    $maintenanceLog = MaintenanceLog::create([
                        'report_detail_id' => $daily_activity_details->id,
                        'photos' => $foto[$pe],
                        'description' => $request->descriptionActivity[$pe],
                    ]);

                    $man_powers = ManPower::create([
                        'name' => $dbUser->name,
                        'position' => $dbUser->position,
                        'report_id' => $daily_reports->id,
                        'notes' => $request->noteManPower[$pe],
                        'user_id' => $dbUser->id,
                    ]);
                    $pe++;
                }
                
                // dd($foto);
            }
            

            if ($request->has('statusBefore')) {
                
                $pe = 0;
                foreach ($request->statusBefore as $row) {
                    
                    
                    $foto[$pe] = ImageHelper::uploadAndResize($request->photosBefore[$pe],$pe,"regular-before");
                    $foto2[$pe] = ImageHelper::uploadAndResize($request->photosAfter[$pe],$pe,"regular-after");


                    $daily_activity_details = DailyActivityDetail::create([
                        'device_id' => $request->deviceReguler[$pe],
                        'report_id' => $daily_reports->id,
                        'activity_description' => $request->activity_description[$pe],
                        'status' => $row
                    ]);

                    $maintenance_logs2 = MaintenanceLog::create([
                        'report_detail_id' => $daily_activity_details->id,
                        'photos' => $foto[$pe] ?? null,
                        'description' => $request->descriptionBefore[$pe] ?? '',
                    ]);

                    if (!$maintenance_logs2) {
                        return back()->with('error', 'Gagal menyimpan maintenance log');
                    }
                    
                    // Pastikan request berisi 'maintenance_item_id_before'
                    
                    // dd($request->maintenance_item_id_before);
                    if ($request->has('maintenance_item_id_before')) {
                        $itemRows= $request->maintenance_item_id_before[$pe];
                        foreach ( $itemRows as  $itemsBefore) {
                            
                            // foreach ($itemsBefore as $itemIdBefore) {
                                $statusBefore = $request->maintenance_item_status_before[$pe][$itemsBefore] ?? 'ERROR';
                                $beforeItem = MaintenanceItem::findOrFail($itemsBefore);
                                // dd($beforeItem->item_name);
                                
                                if (!empty($maintenance_logs2->id)) {
                                    MaintenanceLogDetail::create([
                                        'maintenance_log_id' => $maintenance_logs2->id,
                                        'maintenance_item_id' => $beforeItem->item_name,
                                        'status' => $statusBefore, // Ambil status dari array
                                    ]);
                                    // dd($maintenance_logs2->id);
                                }else {
                                    echo "error";
                                }
                            // }
                        }
                    }
                    $maintenance_log_afters = MaintenanceLogAfter::create([
                        'maintenance_log_id' => $maintenance_logs2->id,
                        'photos' => $foto2[$pe] ?? null,
                        'description' => $request->descriptionAfter[$pe] ?? '',
                    ]);
                    
                                    // dd($maintenance_logs2->id);
                    
                    // Pastikan request berisi 'maintenance_item_id_afters'
                    // dd($request->maintenance_item_status_after);
                    if ($request->has('maintenance_item_id_afters')) {
                        $itemsAfter = $request->maintenance_item_id_afters[$pe];
                        foreach ($itemsAfter as $itemIdAfter) {

                            $statusAfter = $request->maintenance_item_status_after[$pe][$itemIdAfter] ?? 'ERROR';
                            $item = MaintenanceItem::findOrFail($itemIdAfter);
                            
                
                            // Simpan ke database
                            MaintenanceLogAfterDetail::create([
                                'maintenance_log_after_id' => $maintenance_log_afters->id,
                                'item_name' => $item->item_name, // Perbaikan: gunakan id, bukan nama item
                                'status' => $statusAfter,
                            ]);
                        }
                    }

                    $pe++;
                }
                
                // dd($foto);
            }
           
            DB::commit();
            
            return redirect()->route('report.index');
            


        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            // return redirect()->back()->with('message' , );   
            // return response()->json(['error' => 'Failed to save maintenance log', 'message' => $e->getMessage()], 500);
        }
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
