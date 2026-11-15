<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Suppliers::with('purchases')->get();
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
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        $supplier = Suppliers::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Supplier created successfully',
            'data' => $supplier,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Suppliers::with('purchases')->findOrFail($id);
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
        $supplier = Suppliers::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);
        $supplier->update($data);
        return response()->json($supplier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $supplier = Suppliers::findOrFail($id);
        $supplier->delete();
        return response()->json(['message' => 'Supplier deleted successfully']);
    }
}
