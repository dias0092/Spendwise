<?php

namespace App\Http\Controllers;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::all();
        return response()->json($wishlist);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'wish_name' => 'required',
            'timestamp' => 'required',
        ]);

        $wishlistItem = Wishlist::create($request->all());
        return response()->json($wishlistItem, 201);
    }

    public function show(Wishlist $wishlist)
    {
        return response()->json($wishlist);
    }

    public function update(Request $request, Wishlist $wishlist)
    {
        $request->validate([
            'wish_name' => 'required',
            'timestamp' => 'required',
            'target_amount' => 'required',
        ]);

        $wishlist->update($request->all());
        return response()->json($wishlist);
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return response()->json(null, 204);
    }
}
