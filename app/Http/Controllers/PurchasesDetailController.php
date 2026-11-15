<?php

namespace App\Http\Controllers;

use App\Models\PurchasesDetail;
use Illuminate\Http\Request;

class PurchasesDetailController
{
    public function index()
    {
        return response()->json(
            PurchasesDetail::with(['purchase', 'product'])->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_id' => 'required|integer|exists:purchases,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
        ]);

        $detail = PurchasesDetail::create($data)->load(['purchase', 'product']);

        return response()->json($detail, 201);
    }

    public function show(string $id)
    {
        $detail = PurchasesDetail::with(['purchase', 'product'])->findOrFail($id);

        return response()->json($detail);
    }

    public function update(Request $request, string $id)
    {
        $detail = PurchasesDetail::findOrFail($id);
        $data = $request->validate([
            'purchase_id' => 'sometimes|required|integer|exists:purchases,id',
            'product_id' => 'sometimes|required|integer|exists:products,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|nullable|numeric|min:0',
        ]);

        $detail->update($data);

        return response()->json($detail->load(['purchase', 'product']));
    }

    public function destroy(string $id)
    {
        $detail = PurchasesDetail::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'Purchase detail deleted successfully']);
    }
}
