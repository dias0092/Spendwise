<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::where('user_id', $request->user()->id)->get();
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'account_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category'=>'required',
            'payment_method'=>'required',
            'transaction_type' => 'required|in:income,expense',
            'description' => 'sometimes|required',

        ]);

        $transaction = Transaction::create($request->all());
        return response()->json($transaction, 201);
    }

    public function show(Transaction $transaction)
    {
        return response()->json($transaction);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id' => 'required',
            'account_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category'=>'required',
            'payment_method'=>'required',
            'transaction_type' => 'required|in:income,expense',
            'description' => 'sometimes|required',
        ]);

        $transaction->update($request->all());
        return response()->json($transaction);
    }
    public function getTransactionsByType(Request $request, $type)
    {
        $transactions = Transaction::where('transaction_type', $type)
        ->where('user_id', $request->user()->id)
        ->get();
    return response()->json($transactions);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(null, 204);
    }
}
