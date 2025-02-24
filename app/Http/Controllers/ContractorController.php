<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractorController extends Controller
{
    public function index()
    {
        $rowContractor = Contractor::all()->count();
        return view('contractors.index',compact('rowContractor'));
    }

    public function list()
    {
        $data = Contractor::all();

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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Logo tidak wajib
            'contact_information' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            // Simpan file ke storage dan ambil nama file
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/logos'), $fileName);
            $validated['logo'] = $fileName;
        }

        $contractor = Contractor::create($validated);

        return response()->json(['success' => true, 'contractor' => $contractor]);
    }

    public function update(Request $request, $id)
    {
        
        $contractor = Contractor::findOrFail($id);

        $validated = $request->validate([
            'contractor_name' => 'required|string|max:255',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'contact_information' => 'nullable|string|max:255',
        ]);
        
        if ($request->hasFile('logo')) {
            // Hapus file lama jika ada
            if ($contractor->logo && Storage::exists('public/logos/' . $contractor->logo)) {
                Storage::delete('public/logos/' . $contractor->logo);
            }

            // Simpan file baru
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/logos'), $fileName);
            $validated['logo'] = $fileName;
        }

        $contractor->update($validated);

        return response()->json(['success' => true, 'contractor' => $contractor]);
    }

    public function destroy($id)
    {
        $contractor = Contractor::findOrFail($id);

        // Hapus file logo jika ada
        if ($contractor->logo && Storage::exists('public/logos/' . $contractor->logo)) {
            Storage::delete('public/logos/' . $contractor->logo);
        }

        $contractor->delete();

        return response()->json(['message' => 'Contractor deleted successfully']);
    }
}
