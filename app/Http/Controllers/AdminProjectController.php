<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.allProjects.index',[
            'allProjects' => Project::all(),
            'pendingProjects' => Project::where('is_approved', false)->get()
        ]);
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
    public function destroy(Project $project)
    {
    if ($project->image) {
        Storage::delete($project->image);
    }

    if (!$project->delete()) {
        return redirect('/dashboard/allProjects')->with('error', 'Project gagal dihapus!');
    }

    return redirect('/dashboard/allProjects')->with('success', 'Project berhasil dihapus!');
    }

     public function approve(Project $project){
        $project->is_approved = true;
        $project->save();

        return redirect()->back()->with('message', 'Projects disetujui');
    }



}

   