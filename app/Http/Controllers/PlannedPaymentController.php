<?php

namespace App\Http\Controllers;
use App\Models\PlannedPayment;
use Illuminate\Http\Request;

class PlannedPaymentController extends Controller
{
    public function index()
    {
        $plannedPayments = PlannedPayment::all();
        return response()->json($plannedPayments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'account_id' => 'required',
            'amount' => 'required',
            'timestamp' => 'required',
        ]);

        $plannedPayment = PlannedPayment::create($request->all());
        return response()->json($plannedPayment, 201);
    }

    public function show(PlannedPayment $plannedPayment)
    {
        return response()->json($plannedPayment);
    }

    public function update(Request $request, PlannedPayment $plannedPayment)
    {
        $request->validate([
            'user_id' => 'required',
            'account_id' => 'required',
            'amount' => 'required',
            'timestamp' => 'required',
        ]);

        $plannedPayment->update($request->all());
        return response()->json($plannedPayment);
    }

    public function destroy(PlannedPayment $plannedPayment)
    {
        $plannedPayment->delete();
        return response()->json(null, 204);
    }
}
