<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        return view('materials.index');
    }

    public function list()
    {
        $data = Material::all(); 
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'material_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
        ]);

        $material = Material::create($validated);
        return response()->json(['message' => 'Material created successfully', 'data' => $material]);
    }
    public function show($id)
    {
        
        $material = Material::findOrFail($id);
        return response()->json($material);
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'material_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
        ]);

        $material->update($validated);
        return response()->json(['message' => 'Material updated successfully', 'data' => $material]);
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return response()->json(['message' => 'Material deleted successfully']);
    }
}
