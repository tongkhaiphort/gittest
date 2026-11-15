<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController
{
    public function index()
    {
        $orders = Order::with([
            'customer',
            'staff',
            'orderDetails.product',
            'payment'
        ])->get();

        return response()->json([
            'status' => 'success',
            'data' => $orders,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'staff_id' => 'required|integer|exists:staff,id',
            'order_date' => 'nullable|date',
            'status' => 'sometimes|required|string|max:20',
            'total_amount' => 'nullable|numeric|min:0',
        ]);

        $order = Order::create($data)->load([
            'customer',
            'staff',
            'orderDetails.product',
            'payment',
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $order,
        ], 201);
    }

    public function show(string $id)
    {
        $order = Order::with([
            'customer',
            'staff',
            'orderDetails.product',
            'payment'
        ])->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $order,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $data = $request->validate([
            'customer_id' => 'sometimes|required|integer|exists:customers,id',
            'staff_id' => 'sometimes|required|integer|exists:staff,id',
            'order_date' => 'sometimes|nullable|date',
            'status' => 'sometimes|required|string|max:20',
            'total_amount' => 'sometimes|nullable|numeric|min:0',
        ]);

        $order->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $order->load([
                'customer',
                'staff',
                'orderDetails.product',
                'payment',
            ]),
        ]);
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}
