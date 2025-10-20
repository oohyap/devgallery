<?php

use App\Models\User;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Support\Arr;
use GuzzleHttp\Handler\Proxy;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminRolesController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\DashboardProjectController;


Route::get('/', function () {
    return view('home', ['title' => 'Home']); 
});

Route::get('/login', function () {
    return view('login', ['title' => 'Login']); 
});


Route::get('/leaderboards', [LeaderboardController::class, 'leaderboard']);
Route::get('/leaderboards', function () {
    $users = User::orderByDesc('score')->take(10)->get();
    $currentUser = Auth::user();
    return view('leaderboards', ['title' => 'Leaderboards', 'users'=> $users, 'currentUsers' => $currentUser]); 
});

Route::get('/register', function () {
    return view('register', ['title' => 'Register']); 
})->middleware('guest');

Route::get('/projects', function () {
    return view('projects', [
        'title' => 'Projects',
        'projects' => Project::where('is_approved', true)
                             ->filter(request(['search', 'author']))
                             ->latest()
                             ->simplePaginate(6)
    ]);
});


Route::get('/projects/{project:slug}', function (Project $project){
    $comment = Comment::latest()->take(3)->get();
    return view('project', ['title' => 'Own Project', 'project' => $project, 'comment' => $comment]);
});

Route::get('/authors/{user:username}', function (User $user){
    // $projects = $user->project->load('author');
    return view('projects', ['title' => count($user->project) .' Project by '. $user->name, 'projects' => $user->project]);
});


Route::get('/dashboard',[DashboardController::class, 'index'])->middleware('auth')->name('dashboard.index');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard/projects/checkSlug', [DashboardProjectController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/projects', DashboardProjectController::class)->withTrashed()->middleware('auth');

// Route::get('/dashboard/users/{user:id}', AdminUsersController::class)->middleware('admin');
Route::resource('/dashboard/users', AdminUsersController::class)->except('show')->middleware('admin');
Route::resource('/dashboard/comments', AdminCommentController::class)->except('show')->middleware('admin');
Route::resource('/dashboard/allProjects', AdminProjectController::class)->withTrashed()->middleware('admin');
Route::get('/dashboard/allProjects/', [AdminProjectController::class, 'index'])->middleware('admin');
Route::post('/dashboard/allProjects/{project}/approve', [AdminProjectController::class, 'approve'])->middleware('admin');