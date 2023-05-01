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
            'amount' => 'required',
            'date' => 'required',
            'category'=>'required',
            'payment_method'=>'required',
            'transaction_type' => 'required',
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
            'amount' => 'required',
            'date' => 'required',
            'category'=>'required',
            'payment_method'=>'required',
            'description' => 'sometimes|required',
            'transaction_type' => 'required',
        ]);

        $transaction->update($request->all());
        return response()->json($transaction);
    }
    public function getTransactionsByType(Request $request, $type)
    {
        $transactions = Transaction::where('transaction_type', $type)->get();
        return response()->json($transactions);
    }
}
