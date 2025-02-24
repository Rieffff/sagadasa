<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;

class DeviceController extends Controller
{
    public function index()
    {
        $locations = Location::all(); // Untuk dropdown lokasi
        return view('devices.index', compact('locations'));
    }
    
    public function fetchDevices(Request $request)
    {
        if (!$request->ajax()) {
            return abort(402, 'URL tidak di temukan !!');
        }
        $data = Device::with('location')->get();
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        return response()->json(['data' => $data]);
    }
    public function show($id,Request $request)
    {
        if (!$request->ajax()) {
            return abort(402, 'URL tidak di temukan !!');
        }
        
        $data = Device::with('location')->findOrFail($id);
        return response()->json($data);
    }
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'device_name' => 'required|string|max:255',
            'status' => 'required|string|max:5',
            'description' => 'required|string|max:255',
            'id_location' => 'required|exists:locations,id',
        ]);

        $device = Device::create($validated);
        return response()->json(['message' => 'Device created successfully', 'data' => $device]);
    }

    public function update(Request $request, Device $device)
    {
        if($request->id_location == 0){
            $validated = $request->validate([
                'device_name' => 'required|string|max:255',
                'status' => 'required|string|max:5',
                'description' => 'required|string|max:255',
            ]);
    

        }else{
            $validated = $request->validate([
                'device_name' => 'required|string|max:255',
                'status' => 'required|string|max:5',
                'description' => 'required|string|max:255',
                'id_location' => 'required|exists:locations,id',
            ]);
    
        }
        $device->update($validated);
        return response()->json(['message' => 'Device updated successfully', 'data' => $device]);
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return response()->json(['message' => 'Device deleted successfully']);
    }
}
