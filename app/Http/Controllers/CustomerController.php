<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Customer::with('orders')->get();
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
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string|max:255',
        ]);

        $customer = Customer::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Customer created successfully',
            'data' => $customer,
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Customer::with('orders')->findOrFail($id);

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
        $customer = Customer::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string|max:255',
        ]);
        $customer->update($data);
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return response()->json(['message' => 'Customer deleted successfully']);
    }
}
