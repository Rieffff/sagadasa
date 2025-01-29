<?php

namespace App\Http\Controllers;

use App\Models\DailyProblems;
use App\Http\Requests\StoreDailyProblemsRequest;
use App\Http\Requests\UpdateDailyProblemsRequest;

class DailyProblemsController extends Controller
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
    public function store(StoreDailyProblemsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyProblems $dailyProblems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyProblems $dailyProblems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDailyProblemsRequest $request, DailyProblems $dailyProblems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyProblems $dailyProblems)
    {
        //
    }
}
