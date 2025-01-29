<?php

namespace App\Http\Controllers;

use App\Models\DailyActivity;
use App\Http\Requests\StoreDailyActivitiesRequest;
use App\Http\Requests\UpdateDailyActivitiesRequest;

class DailyActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDailyActivitiesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyActivities $dailyActivities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyActivities $dailyActivities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDailyActivitiesRequest $request, DailyActivities $dailyActivities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyActivities $dailyActivities)
    {
        //
    }
}
