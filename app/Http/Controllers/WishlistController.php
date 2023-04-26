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
            'description'=> 'required' ,
            'icon' => 'required',
            'target_amount' => 'required',
            'initial_target_amount' =>'required' ,
            'color' => 'required',

        ]);
        $progress = ($request->initial_target_amount / $request->target_amount) * 100;
        $wishlistItem = Wishlist::create(
            $request->all(),[
            'progress' => $progress
            ]
        );
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
            'description'=> 'required' ,
            'icon' => 'required',
            'initial_target_amount' =>'required',
            'color' => 'required',
        ]);
        $progress = ($request->initial_target_amount / $request->target_amount) * 100;
        $wishlist->update($request->all(),[
            'progress' => $progress
        ]);
        return response()->json($wishlist);
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return response()->json(null, 204);
    }
}
