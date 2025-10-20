<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function leaderboard(){
        $users = User::orderByDesc('score')->take(10)->get();
        return view('leaderboard', ['users'=> $users]);
    }
}
