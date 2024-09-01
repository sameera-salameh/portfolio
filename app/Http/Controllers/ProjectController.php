<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'desciption' => 'required|max:1000',
            'url' => 'required|url',
            'photo' => 'image',
        ]);

        $photoname = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoname = time() . "." . $photo->getClientOriginalExtension();
            $photo->move(public_path('photos'), $photoname);
        }

        $project = new Project([
            'name' => $validatedData['name'],
            'desciption' => $validatedData['desciption'],
            'url' => $validatedData['url'],
            'photo' => $photoname,
            'user_id' => auth()->id(),
        ]);

        $project->save();

        return response()->json(['message' => 'Project added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|max:255',
            'desciption' => 'sometimes|required|max:1000',
            'url' => 'sometimes|required|url',
            'photo' => 'sometimes|image',
        ]);

        $project = Project::find($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoname = time() . "." . $photo->getClientOriginalExtension();
            $photo->move(public_path('photos'), $photoname);
            $validatedData['photo'] = $photoname;
        }

        $project->update($validatedData);

        return response()->json(['message' => 'Project updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}
