<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // $validateData['password'] = bcrypt()
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        $request->session()->flash('success', 'Registration succesfull! Please Login');
        return redirect('/login');
    }
}
