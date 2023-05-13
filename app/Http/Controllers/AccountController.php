<?php

namespace App\Http\Controllers;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $accounts = Account::where('user_id', $request->user()->id)->get();
            return response()->json($accounts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_name' => 'required',
            'currency_id' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['user_id'] = $request->user()->id;

        $account = Account::create($requestData);
        return response()->json($account, 201);
    }

    public function show(Request $request, Account $account)
    {
        if ($request->user()->id !== $account->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($account);
    }

    public function update(Request $request, Account $account)
    {
        $request->validate([
            'account_name' => 'required',
            'currency_id' => 'required',
        ]);

        $requestData = $request->all();
        $requestData['user_id'] = $request->user()->id;

        $account->update($requestData);
        return response()->json($account);
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return response()->json(null, 204);
    }
}
