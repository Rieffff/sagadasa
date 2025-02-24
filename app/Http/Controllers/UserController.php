<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sesId = Auth::User()->id;

        $data = User::where('id', '!=', $sesId)->where('position','!=','Developer')->get();      
        $data = $data->map(function ($item, $key) {
            $item->index = $key + 1; // Index dimulai dari 1
            return $item;
        });
        return view('user.index',compact('data'));
    }

    
    public function show($id){

       
        $data = User::findOrFail($id);
        // dd($data);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255',
            'password' => 'required|string',
            'position' => 'required|string|max:255',
            'contact' => 'required|string|max:50',
        ]);
        if ($request->position === 'technician') {
            $position = "Technician";
        }elseif($request->position === 'supervisor'){
            $position = "Supervisor";
        }elseif($request->position === 'admin'){
            $position = 'Admin';
        }

        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->position,
            'position' => $position,
            'contact' => $request->contact,
        ]);
        
        return response()->json(['message' => 'User created successfully', 'data' => $User]);
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
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'contact' => 'required|string|max:50',
        ]);


        if ($request->position === 'technician') {
            $position = "Technician";
        }elseif($request->position === 'supervisor'){
            $position = "Supervisor";
        }elseif($request->position === 'admin'){
            $position = 'Admin';
        }

        $User = DB::table('users')
        ->where('id', $request->id)
        ->Update([
            'name' => $request->name,
            'role' => $request->position,
            'position' => $position,
            'contact' => $request->contact,
        ]);
        
        if ($request->password != '') {
            $request->validate([
                'password' => 'required|string|max:255|min:8',
            ]);
            $User = DB::table('users')
            ->where('id', $request->id)
            ->Update([
                'password' => Hash::make($request->password),
            ]);
            # code...
        }
        return response()->json(['message' => 'User created successfully', 'data' => $User]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
