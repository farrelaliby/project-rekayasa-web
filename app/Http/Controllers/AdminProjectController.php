<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'teknologi' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'status' => 'required|in:active,archived',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = time() . '_' . $request->file('image')->getClientOriginalName();
            // Disimpan ke folder public/gambar
            $request->file('image')->move(public_path('gambar'), $imagePath);
        }   

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'teknologi' => $request->teknologi,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if ($project->image) {
            // Hapus file gambar jika ada
            $imagePath = public_path('gambar/' . $project->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'teknologi' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'status' => 'required|in:active,archived',
        ]);

        $project = Project::findOrFail($id);
        $imagePath = $project->image;

        if ($request->hasFile('image')) {
            // Hapus file gambar lama jika ada
            if ($project->image) {
                $oldImagePath = public_path('gambar/' . $project->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            // Simpan file gambar baru
            $imagePath = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('gambar'), $imagePath);
            $project->image = $imagePath;
        }

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'teknologi' => $request->teknologi,
            'image' => $imagePath,
            'status' => $request->status,
        ]);   

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }
}