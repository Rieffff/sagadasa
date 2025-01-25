<?php

namespace App\Http\Controllers;

use App\Models\MaterialReplacement;
use App\Http\Requests\StoreMaterialReplacementRequest;
use App\Http\Requests\UpdateMaterialReplacementRequest;

class MaterialReplacementController extends Controller
{
    public function index()
    {
        $replacements = MaterialReplacement::with(['maintenanceLog', 'material'])->get();
        return response()->json($replacements);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'maintenance_log_id' => 'required|exists:maintenance_logs,id',
            'material_id' => 'required|exists:materials,id',
            'quantity' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $replacement = MaterialReplacement::create($data);

        return response()->json(['message' => 'Material replacement created successfully', 'data' => $replacement]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'maintenance_log_id' => 'sometimes|exists:maintenance_logs,id',
            'material_id' => 'sometimes|exists:materials,id',
            'quantity' => 'sometimes|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $replacement = MaterialReplacement::findOrFail($id);
        $replacement->update($data);

        return response()->json(['message' => 'Material replacement updated successfully', 'data' => $replacement]);
    }

    public function destroy($id)
    {
        $replacement = MaterialReplacement::findOrFail($id);
        $replacement->delete();

        return response()->json(['message' => 'Material replacement deleted successfully']);
    }
}
