<?php

namespace App\Http\Controllers;

use App\Models\staff;
use Illuminate\Http\Request;

class StaffController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return staff::with('orders')->get();
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
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'gender' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:20',
            'salary' => 'nullable|numeric|min:0',
        ]);

        $staff = staff::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Staff created successfully',
            'data' => $staff,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return staff::with('orders')->findOrFail($id);
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
        $staff = staff::findOrFail($id);
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:100',
            'gender' => 'sometimes|nullable|string|max:10',
            'phone' => 'sometimes|nullable|string|max:20',
            'salary' => 'sometimes|nullable|numeric|min:0',
        ]);

        $staff->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Staff updated successfully',
            'data' => $staff,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $staff = staff::findOrFail($id);
        $staff->delete();
        return response()->json(['message' => 'Staff deleted successfully']);
    }
}
