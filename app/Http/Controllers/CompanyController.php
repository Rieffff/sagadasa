<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $rowCompany = Company::all()->count();
        return view('companies.index',compact('rowCompany'));
    }

    public function show($id,Request $request)
    {
        if (!$request->ajax()) {
            return abort(402, 'URL tidak di temukan !!');
        }
        $data = Company::findOrFail($id);
        return response()->json($data);
    }

    public function fetch(Request $request)
    {
        $data = Company::all();
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        if (!$request->ajax()) {
            return abort(402, 'URL tidak di temukan !!');
        }
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan file logo
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/logos'), $fileName);
            $validated['logo'] = $fileName;
        }

        $company = Company::create($validated);

        return response()->json(['message' => 'Company added successfully', 'company' => $company]);
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tidak wajib di-update
        ]);

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($company->logo && Storage::exists('public/logos/' . $company->logo)) {
                Storage::delete('public/logos/' . $company->logo);
            }

            // Simpan logo baru
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/logos'), $fileName);
            $validated['logo'] = $fileName;
        }

        $company->update($validated);

        return response()->json(['message' => 'Company updated successfully', 'company' => $company]);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        // Hapus logo jika ada
        if ($company->logo && Storage::exists('public/logos/' . $company->logo)) {
            Storage::delete('public/logos/' . $company->logo);
        }

        $company->delete();

        return response()->json(['message' => 'Company deleted successfully']);
    }
}