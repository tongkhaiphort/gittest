<?php

namespace App\Http\Controllers;

use App\Models\Purchases;
use Illuminate\Http\Request;

class PurchasesController
{
    public function index()
    {
        return response()->json(
            Purchases::with(['supplier', 'purchaseDetails.product'])->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'purchase_date' => 'nullable|date',
            'total_amount' => 'nullable|numeric|min:0',
        ]);

        $purchase = Purchases::create($data)->load(['supplier', 'purchaseDetails.product']);

        return response()->json($purchase, 201);
    }

    public function show(string $id)
    {
        $purchase = Purchases::with(['supplier', 'purchaseDetails.product'])->findOrFail($id);

        return response()->json($purchase);
    }

    public function update(Request $request, string $id)
    {
        $purchase = Purchases::findOrFail($id);
        $data = $request->validate([
            'supplier_id' => 'sometimes|required|integer|exists:suppliers,id',
            'purchase_date' => 'sometimes|nullable|date',
            'total_amount' => 'sometimes|nullable|numeric|min:0',
        ]);

        $purchase->update($data);

        return response()->json($purchase->load(['supplier', 'purchaseDetails.product']));
    }

    public function destroy(string $id)
    {
        $purchase = Purchases::findOrFail($id);
        $purchase->delete();

        return response()->json(['message' => 'Purchase deleted successfully']);
    }
}
