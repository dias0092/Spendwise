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
            'name' => 'required',
            'deadline' => 'required',
            'description'=> 'required' ,
            'status'=>'required',
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

    public function show(Goal $goal)
    {
        return response()->json($goal);
    }

    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'deadline' => 'required',
            'description'=> 'required' ,
            'status'=>'required',
            'icon' => 'required',
            'target_amount' => 'required',
            'initial_target_amount' =>'required' ,
            'color' => 'required',
        ]);
        $progress = ($request->initial_target_amount / $request->target_amount) * 100;
        $goal->update($request->all());
        $goal->progress = $progress;
        $goal->save();
        return response()->json($goal);
    }
    public function getGoalsByStatus(Request $request, $status)
    {
        $goals = Goal::where('status', $status)->get();
        return response()->json($goals);
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        return response()->json(null, 204);
    }
}
