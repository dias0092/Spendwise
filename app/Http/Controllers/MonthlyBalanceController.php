<?php

namespace App\Http\Controllers;

use App\Models\MonthlyBalance;
use Illuminate\Http\Request;
use App\Notifications\LowBalanceNotification;
use Illuminate\Support\Facades\Notification;


class MonthlyBalanceController extends Controller
{
    public function index(Request $request)
    {
        $monthlyBalances = MonthlyBalance::where('user_id', $request->user()->id)->get();
        return response()->json($monthlyBalances);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'balance' => 'required|numeric',
        ]);
        $requestData = $request->all();
        $requestData['user_id'] = $request->user()->id;

        $monthlyBalance = MonthlyBalance::create($requestData);

        // Send LowBalanceNotification if balance is less than 1000
        if ($monthlyBalance->balance < 1000) {
            Notification::send($request->user(), new LowBalanceNotification());
        }

        return response()->json($monthlyBalance, 201);
    }

    public function show(Request $request, MonthlyBalance $monthlyBalance)
    {
        if ($request->user()->id !== $monthlyBalance->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($monthlyBalance);
    }

    public function update(Request $request, MonthlyBalance $monthlyBalance)
    {
        $request->validate([
            'date' => 'required|date',
            'balance' => 'required|numeric',
        ]);
        $requestData = $request->all();
        $requestData['user_id'] = $request->user()->id;

        $monthlyBalance->update($requestData);
        return response()->json($monthlyBalance);
    }

    public function destroy(MonthlyBalance $monthlyBalance)
    {
        $monthlyBalance->delete();
        return response()->json(null, 204);
    }
}
