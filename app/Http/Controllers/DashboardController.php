<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user(); // ambil user yang login
        $score = $user->score; // ambil nilai score user
        return view('dashboard.index',[
            'projects' => Project::where('author_id',Auth::id())->get(),
            'score' => $score,
            'countUser' => User::count(),
            'countProject' => Project::where('author_id',Auth::id())->count(),
            'countComment' => Comment::where('author_id', Auth::id())->count()
        ]);
    }
}
