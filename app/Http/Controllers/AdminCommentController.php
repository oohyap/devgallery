<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.comments.index',[
            'comments' => Comment::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    // Validasi input
$validatedData = $request->validate([
    'content' => 'required|max:255',
    'project_id' => 'required|exists:projects,id',
]);

$user = Auth::user();

// Tambahkan ID user ke data komentar
$validatedData['author_id'] = $user->id;

// Simpan komentar
Comment::create($validatedData);

// Hitung jumlah komentar hari ini
$todayComments = Comment::where('author_id', $user->id)
    ->whereDate('created_at', Carbon::today())
    ->count();

// Tambahkan poin jika belum lebih dari 3 komentar hari ini
if ($todayComments <= 3) {
    $user->score += 2;
    $user->save();
}

    return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect('/dashboard/comments')->with('success', 'Comment has been soft deleted!');
    }
}
