<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Notifications\NewTransactionNotification;

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

            'account_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category'=>'required',
            'payment_method'=>'required',
            'transaction_type' => 'required|in:income,expense',
            'description' => 'sometimes|required',

        ]);
        $requestData = $request->all();
        $requestData['user_id'] = $request->user()->id;

        $transaction = Transaction::create($requestData);
        // Send notification
        $request->user()->notify(new NewTransactionNotification($transaction));
        return response()->json($transaction, 201);
    }

    public function show(Request $request, Transaction $transaction)
    {
        if ($request->user()->id !== $transaction->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($transaction);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([

            'account_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category'=>'required',
            'payment_method'=>'required',
            'transaction_type' => 'required|in:income,expense',
            'description' => 'sometimes|required',
        ]);

        $requestData = $request->all();
        $requestData['user_id'] = $request->user()->id;

        $transaction->update($requestData);
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
