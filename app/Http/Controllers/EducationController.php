<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations = Education::all();
        return response()->json(['education' => $educations]);
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|max:50',
                'description' => 'required|max:255',
                'institution' => 'required|max:255',
                'completion_date' => 'required|date',
            ]);
        
            $completion_date = \DateTime::createFromFormat('d-m-Y', $request->completion_date);
        
            if ($completion_date) {
                $completion_date = $completion_date->format('Y-m-d');
            } else {
                return response()->json(['error' => 'Invalid date format'], 400);
            }
        
            $education = new Education([
                "name" => $validatedData['name'], 
                "description" => $validatedData['description'], 
                "institution" => $validatedData['institution'], 
                "completion_date" => $completion_date, // استخدام التاريخ المنسق هنا
                'user_id' => auth()->id(),
            ]);
        
            $education->save();
        
            return response()->json(['message' => 'Education added successfully']);
        }
        

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $education = Education::find($id);

        if (!$education) {
            return response()->json(['error' => 'Education not found'], 404);
        }
    
        return response()->json($education);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|max:50',
            'description' => 'sometimes|required|max:255',
            'institution' => 'sometimes|required|max:255',
            'completion_date' => 'sometimes|required|date',
        ]);
    
        $education = Education::find($id);
    
        if (!$education) {
            return response()->json(['error' => 'Education not found'], 404);
        }
    
        if (isset($validatedData['completion_date'])) {
            $completion_date = \DateTime::createFromFormat('d-m-Y', $validatedData['completion_date']);
    
            if ($completion_date) {
                $validatedData['completion_date'] = $completion_date->format('Y-m-d');
            } else {
                return response()->json(['error' => 'Invalid date format'], 400);
            }
        }
    
        $education->update($validatedData);
    
        return response()->json(['message' => 'Education updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $education = Education::find($id);

        if (!$education) {
            return response()->json(['error' => 'Education not found'], 404);
        }
    
        $education->delete();
    
        return response()->json(['message' => 'Education deleted successfully']);
    }
}
