<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TechnicianReportController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'location_id' => 'required|exists:locations,id',
            'device_id' => 'required|exists:devices,id',
            'activity_details' => 'required|string',
            'status' => 'required|in:regular,non-regular',
        ]);
    
        // Save the daily report
        $dailyReport = DailyReport::create([
            'report_date' => now(),
            'company_id' => $validated['company_id'],
            'location_id' => $validated['location_id'],
            'device_id' => $validated['device_id'],
            'user_id' => auth()->id(), // Use the logged-in user's ID
            'activity_details' => $validated['activity_details'],
            'status' => $validated['status'],
        ]);
    
        return response()->json(['success' => true, 'message' => 'Report saved successfully!']);
    }
}
