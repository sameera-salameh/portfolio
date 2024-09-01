<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:255',
        ]);

        $service = new Service([
            "name" => $validatedData['name'], 
            "description" => $validatedData['description'], 
        ]);
    
        auth()->user()->services()->save($service);
        return response()->json(['message' => 'Service added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:255',
        ]);

        $Service = Service::findOrFail($id);
        $Service->update([
            "name" => $validatedData['name'],
            "description" => $validatedData['description'],
        ]);
        return response()->json(['message' => 'Service updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = service::findOrFail($id);
        $service->delete();
        return response()->json(['service' => 'service deleted successfully']);
    }
}
