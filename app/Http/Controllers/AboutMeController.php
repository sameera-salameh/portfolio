<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutMeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about_me = AboutMe::all();
        return response()->json(['about_me' => $about_me]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (AboutMe::count() > 0) {
            return response()->json(['error' => 'Only one about me record is allowed'], 400);
        }
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'bio' => 'required|max:1000',
            'photo' => 'image',
        ]);

        $photoname = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoname = time() . "." . $photo->getClientOriginalExtension();
            $photo->move(public_path('photos'), $photoname);
        }

        $aboutme = new aboutme([
            'name' => $validatedData['name'],
            'bio' => $validatedData['bio'],
            'photo' => $photoname,
            'user_id' => auth()->id(),
        ]);

        $aboutme->save();

        return response()->json(['message' => 'aboutme added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutMe $aboutMe)
    {
        return response()->json(['About_me' => $aboutMe]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|max:255',
            'bio' => 'sometimes|required|max:1000',
            'photo' => 'sometimes|image',
        ]);

        $aboutme = Aboutme::find($id);

        if (!$aboutme) {
            return response()->json(['error' => 'about me not found'], 404);
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoname = time() . "." . $photo->getClientOriginalExtension();
            $photo->move(public_path('photos'), $photoname);
            $validatedData['photo'] = $photoname;
        }

        $aboutme->update($validatedData);

        return response()->json(['message' => 'about me updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutMe $aboutMe)
    {
        $aboutMe->delete();
        return response()->json(['about_me' => 'About me deleted successfully']);
    }
}
