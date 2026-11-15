<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController
{
    public function index()
    {
        return response()->json(
            OrderDetail::with(['order', 'product'])->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
        ]);

        $detail = OrderDetail::create($data)->load(['order', 'product']);

        return response()->json($detail, 201);
    }

    public function show(string $id)
    {
        $detail = OrderDetail::with(['order', 'product'])->findOrFail($id);

        return response()->json($detail);
    }

    public function update(Request $request, string $id)
    {
        $detail = OrderDetail::findOrFail($id);
        $data = $request->validate([
            'order_id' => 'sometimes|required|integer|exists:orders,id',
            'product_id' => 'sometimes|required|integer|exists:products,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|nullable|numeric|min:0',
        ]);

        $detail->update($data);

        return response()->json($detail->load(['order', 'product']));
    }

    public function destroy(string $id)
    {
        $detail = OrderDetail::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'Order detail deleted successfully']);
    }
}
