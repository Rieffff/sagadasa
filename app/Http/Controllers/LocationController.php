<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return view('locations.index');
    }
    public function fetchLocations()
    {
        $locations = Location::with('devices')->get();
        return response()->json(['data' => $locations]);
    }

    public function list()
    {
        $data = Location::all(); 
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        return response()->json(['data' => $data]);
    }
    public function show($id)
    {
        
        $Location = Location::findOrFail($id);
        return response()->json($Location);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $location = Location::create($validated);
        return response()->json(['message' => 'Location created successfully', 'data' => $location]);
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $location->update($validated);
        return response()->json(['message' => 'Location updated successfully', 'data' => $location]);
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return response()->json(['message' => 'Location deleted successfully']);
    }
}
