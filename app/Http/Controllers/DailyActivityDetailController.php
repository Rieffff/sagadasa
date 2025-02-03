<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use App\Models\MaintenanceLog;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Device;
use App\Models\MaintenanceItem;
use App\Models\DailyActivityDetail;
use App\Http\Requests\Storedaily_activity_detailsRequest;
use App\Http\Requests\Updatedaily_activity_detailsRequest;

class DailyActivityDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $report = DailyReport::findOrFail($id);
        // dd($report);
        $reportLocation = $report->location;
        $location = Location::where("location_name",'=',$reportLocation)->first();
        $idLocation = $location->id;
        $device = Device::where('id_location','=',$idLocation)->get();
        $id_report = $id;
        return view('daily_activity_details.index', compact('report','device','id_report'));
    }

    public function getData($id)
    {
        $data = DailyActivityDetail::with(['device'])->get();
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required',
            'report_id' => 'required',
            'activity_description' => 'required',
            'status' => 'required',
        ]);

        DailyActivityDetail::create($request->all());

        return response()->json(['message' => 'Daily Report berhasil ditambahkan']);
    }
    /**
     * Display the specified resource.
     */
    public function show(daily_activity_details $daily_activity_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(daily_activity_details $daily_activity_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatedaily_activity_detailsRequest $request, daily_activity_details $daily_activity_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $activityDetail = DailyActivityDetail::findOrFail($id);
        $activityDetail->delete();

        return response()->json(['success' => 'Activity detail deleted successfully.']);
    }
}
