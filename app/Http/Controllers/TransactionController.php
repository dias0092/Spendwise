<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'account_id' => 'required',
            'category_id' => 'required',
            'amount' => 'required',
            'timestamp' => 'required',
            'transaction_type' => 'required'

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
            'category_id' => 'required',
            'amount' => 'required',
            'timestamp' => 'required',
            'transaction_type' => 'required',
        ]);

        $transaction->update($request->all());
        return response()->json($transaction);
    }
}
