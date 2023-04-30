<?php

namespace App\Http\Controllers;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return response()->json($accounts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'account_name' => 'required',
            'currency_id' => 'required',
        ]);

        $account = Account::create($request->all());
        return response()->json($account, 201);
    }

    public function show(Request $request, Account $account)
    {
        if ($request->user()->id !== $account->user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json($account);
    }

    public function update(Request $request, Account $account)
    {
        $request->validate([
            'account_name' => 'required',
            'currency_id' => 'required',
        ]);

        $account->update($request->all());
        return response()->json($account);
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return response()->json(null, 204);
    }
}
