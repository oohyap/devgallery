<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.projects.index',[
            'projects' => Project::where(['author_id'=> Auth::id() , 'is_approved' => true])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'slug' => 'required|unique:projects',
        'body' => 'required',
        'hosting' => 'required',
        'image' => 'required|array|min:3|max:3',
        'image.*' => 'required|image|file|max:5120|dimensions:min_width=1000,max_width=1980,min_height=600,max_height=1100',
    ],
    [
        'image.min' => 'Minimal unggah 3 gambar.',
        'image.max' => 'Maksimal unggah 3 gambar.',
        'image.*.image' => 'Semua file harus berupa gambar.',
    ]);

    // Tambahkan field tambahan
    $data = $validatedData;
    unset($data['image']);
    $data['author_id'] = Auth::user()->id;
    $data['is_approved'] = false;

    // Simpan project utama
    $project = Project::create($data);

    // Tambah skor user
    $user = auth()->user();
    $user->score += 10;
    $user->save();

    // Simpan setiap gambar
    foreach ($request->file('image') as $img) {
        $path = $img->store('project-images', 'public');
        ProjectImage::create([
            'project_id' => $project->id,
            'image_path' => $path
        ]);
    }

    return redirect('/dashboard/projects')->with('success', 'New Project has been added, You got 10 Points!');
}

    /**
     * Display the specified resource.
     */
 public function show(Project $project)
{
    // Eager load relasi firstImage supaya gambar pertama tersedia
    $project->load('firstImage');

    return view('dashboard.projects.show', [
        'project' => $project,
        'firstImage' => $project->firstImage,
    ]);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
         return view('dashboard.projects.edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Project $project)
    {
    $rules = [
        'title' => 'required|max:255',
        'body' => 'required',
        'hosting' => 'required',
        'image' => 'sometimes|array|min:3|max:3',
        'image.*' => 'image|file|max:5120|dimensions:min_width=1000,max_width=1980,min_height=600,max_height=1100',
    ];

    if ($request->slug !== $project->slug) {
        $rules['slug'] = 'required|unique:projects';
    }

    $validatedData = $request->validate($rules);

    $data = $validatedData;
    unset($data['image']);
    $data['author_id'] = Auth::user()->id;

    // Update project utama
    $project->update($data);

    // Kalau ada gambar baru dikirim, hapus gambar lama dan simpan baru
    if ($request->hasFile('image')) {
        // Hapus gambar lama
        foreach ($project->images as $img) {
            Storage::disk('public')->delete($img->image_path);
            $img->delete();
        }

        // Simpan gambar baru
        foreach ($request->file('image') as $img) {
            $path = $img->store('project-images', 'public');
            ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => $path
            ]);
        }
    }

    return redirect('/dashboard/projects')->with('success', 'Project has been updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if($project->image){
            Storage::delete($project->image);
        }
        Project::destroy($project->id);
        return redirect('/dashboard/projects')->with('success', 'Project has been deleted!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Project::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
