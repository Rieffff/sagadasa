<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceItem;
use App\Http\Requests\StoreMaintenanceItemRequest;
use App\Http\Requests\UpdateMaintenanceItemRequest;
use Illuminate\Http\Request;

class MaintenanceItemController extends Controller
{
    public function index()
    {
        return view('maintenance_items.index');
    }

    public function list()
    {
        $data = MaintenanceItem::all(); 
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        return response()->json(['data' => $data]);
    }
    public function show($id)
    {
        
        $MaintenanceItem = MaintenanceItem::findOrFail($id);
        return response()->json($MaintenanceItem);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item = MaintenanceItem::create($validated);
        return response()->json(['message' => 'Maintenance item created successfully', 'data' => $item]);
    }

    public function update(Request $request, MaintenanceItem $maintenanceItem)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $maintenanceItem->update($validated);
        return response()->json(['message' => 'Maintenance item updated successfully', 'data' => $maintenanceItem]);
    }

    public function destroy(MaintenanceItem $maintenanceItem)
    {
        $maintenanceItem->delete();
        return response()->json(['message' => 'Maintenance item deleted successfully']);
    }
}
