<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::all();
        return response()->json($skills);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'proficiency_level' => 'required|max:255',
        ]);

        $skill = new Skill([
            "name" => $validatedData['name'], 
            "proficiency_level" => $validatedData['proficiency_level'], 
        ]);
    
        auth()->user()->skills()->save($skill);
        return response()->json(['message' => 'skill added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $skill = Skill::findOrFail($id);
        return response()->json($skill);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'proficiency_level' => 'required|max:20',
        ]);

        $skill = Skill::findOrFail($id);
        $skill->update([
            "name" => $validatedData['name'],
            "proficiency_level" => $validatedData['proficiency_level'],
        ]);
        return response()->json(['message' => 'skill updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return response()->json(['skill' => 'skill deleted successfully']);
    }
}
