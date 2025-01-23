<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sesId = Auth::User()->id;

        $data = User::where('id', '!=', $sesId)->get();      
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        return view('user.index',compact('data'));
    }

    public function list(){

        $sesId = Auth::User()->id;

        $data = User::where('id', '!=', $sesId)->get();      
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        // dd($data);
        return response()->json($data);
    }
    public function show($id){

       
        $data = User::findOrFail($id);

        return response()->json($data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
