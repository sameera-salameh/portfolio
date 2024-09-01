<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|max:50',
            'info' => 'required|max:255',
        ]);

        $contact = new Contact([
            "type" => $validatedData['type'], 
            "info" => $validatedData['info'], 
        ]);
    
        auth()->user()->contacts()->save($contact);
        return response()->json(['message' => 'Contact added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'required|max:50',
            'info' => 'required|max:255',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update([
            "type" => $validatedData['type'],
            "info" => $validatedData['info'],
        ]);
        return response()->json(['message' => 'Contact updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['Contact' => 'Contact deleted successfully']);
    }
}
