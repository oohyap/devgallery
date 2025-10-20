<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create',[
            'users' => User::all()
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'name' => 'required|string|max:20',
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required|string|min:5',

        ]);
        $validatedData['password'] = Hash::make($request->password);

        User::create($validatedData);

        // dd($validated);
        // return 'Data diterima!';
        return redirect('/dashboard/users/')->with('success', 'New User has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'username' => 'required',
            'email' => 'required|email',
            'is_admin' => 'required'

        ];
       

        $validatedData = $request->validate($rules); 

        $user->update($validatedData);
        // dd($validated);
        // return 'Data diterima!';
        return redirect('/dashboard/users/')->with('success', 'User has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users/')->with('success', 'User has been deleted!');
    }
    
}
