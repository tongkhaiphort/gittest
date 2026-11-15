<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController
{
    public function index()
    {
        return response()->json(Payment::with('order')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'amount' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string|max:50',
            'payment_date' => 'nullable|date',
        ]);

        $payment = Payment::create($data)->load('order');

        return response()->json($payment, 201);
    }

    public function show(string $id)
    {
        $payment = Payment::with('order')->findOrFail($id);

        return response()->json($payment);
    }

    public function update(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id);
        $data = $request->validate([
            'order_id' => 'sometimes|required|integer|exists:orders,id',
            'amount' => 'sometimes|nullable|numeric|min:0',
            'payment_method' => 'sometimes|nullable|string|max:50',
            'payment_date' => 'sometimes|nullable|date',
        ]);

        $payment->update($data);

        return response()->json($payment->load('order'));
    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
