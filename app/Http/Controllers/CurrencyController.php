<?php

namespace App\Http\Controllers;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        return response()->json($currencies);
    }

    public function store(Request $request)
    {
        $request->validate([
            'currency_code' => 'required',
            'currency_name' => 'required',
        ]);

        $currency = Currency::create($request->all());
        return response()->json($currency, 201);
    }

    public function show(Currency $currency)
    {
        return response()->json($currency);
    }

    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'currency_code' => 'required',
            'currency_name' => 'required',
        ]);

        $currency->update($request->all());
        return response()->json($currency);
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();
        return response()->json(null, 204);
    }
}
