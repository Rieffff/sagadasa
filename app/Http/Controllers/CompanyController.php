<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    public function index()
    {
        return view('companies.index');
    }
    public function show($id)
    {
        
        $data = Company::findOrFail($id);
        return response()->json($data);
    }
    public function fetch()
    {
        $data = Company::all();
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        Company::create($validated);
        return response()->json(['message' => 'Company added successfully']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        $company = Company::findOrFail($id);
        $company->update($validated);

        return response()->json(['message' => 'Company updated successfully']);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return response()->json(['message' => 'Company deleted successfully']);
    }
}
