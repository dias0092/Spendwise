<?php

namespace App\Http\Controllers;

use App\Models\MonthlyBalance;
use Illuminate\Http\Request;

class MonthlyBalanceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $monthlyBalances = $user->monthlyBalances;

        return response()->json($monthlyBalances);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'balance' => 'required|numeric',
        ]);

        $user = $request->user();
        $monthlyBalance = new MonthlyBalance($request->all());
        $user->monthlyBalances()->save($monthlyBalance);

        return response()->json($monthlyBalance, 201);
    }

    public function show(MonthlyBalance $monthlyBalance)
    {
        return response()->json($monthlyBalance);
    }

    public function update(Request $request, MonthlyBalance $monthlyBalance)
    {
        $request->validate([
            'date' => 'required|date',
            'balance' => 'required|numeric',
        ]);

        $monthlyBalance->update($request->all());
        return response()->json($monthlyBalance);
    }

    public function destroy(MonthlyBalance $monthlyBalance)
    {
        $monthlyBalance->delete();
        return response()->json(null, 204);
    }
}
