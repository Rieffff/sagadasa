<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Http\Requests\StoreContractorRequest;
use App\Http\Requests\UpdateContractorRequest;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function index()
    {
        return view('contractors.index');
    }

    public function list()
    {
        // return response()->json(Contractor::all());
        $data = Contractor::all(); // Ganti `Model` dengan model Anda.

        // Tambahkan kolom index manual
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });

        return response()->json(['data' => $data]);
    }
    public function show($id)
    {
        
        $contractor = Contractor::findOrFail($id);
        return response()->json($contractor);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contractor_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contract_ref' => 'nullable|string|max:255',
            'contact_information' => 'nullable|string|max:255',
        ]);

        $contractor = Contractor::create($validated);
        return response()->json($contractor);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'contractor_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contract_ref' => 'nullable|string|max:255',
            'contact_information' => 'nullable|string|max:255',
        ]);

        $contractor = Contractor::findOrFail($id);
        $contractor->update($validated);
        return response()->json($contractor);
    }

    public function destroy($id)
    {
        Contractor::destroy($id);
        return response()->json(['message' => 'Contractor deleted successfully']);
    }
}
