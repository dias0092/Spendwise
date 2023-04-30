<?php

namespace App\Http\Controllers;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $wishlist = Goal::all();
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
        $wishlistItem = Goal::create($request->all());
        $wishlistItem->progress = $progress;
        $wishlistItem->save();
        return response()->json($wishlistItem, 201);
    }

    public function show(Goal $wishlist)
    {
        return response()->json($wishlist);
    }

    public function update(Request $request, Goal $wishlist)
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
        $wishlist->update($request->all());
        $wishlist->progress = $progress;
        $wishlist->save();
        return response()->json($wishlist);
    }
    public function getGoalsByStatus(Request $request, $status)
    {
        $goals = Goal::where('status', $status)->get();
        return response()->json($goals);
    }

    public function destroy(Goal $wishlist)
    {
        $wishlist->delete();
        return response()->json(null, 204);
    }
}
