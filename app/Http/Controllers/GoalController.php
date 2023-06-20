<?php

namespace App\Http\Controllers;
use App\Models\Goal;
use Illuminate\Http\Request;
use App\Notifications\GoalDeadlineNotification;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class GoalController extends Controller
{
    public function index(Request $request)
    {
        $goals = Goal::where('user_id', $request->user()->id)->get();
        return response()->json($goals);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'deadline' => 'required',
            'description'=> 'required' ,
            'status'=>'required',
            'icon' => 'required',
            'target_amount' => 'required',
            'initial_target_amount' =>'required' ,
            'color' => 'required',

        ]);
        $requestData = $request->all();
        $requestData['user_id'] = $request->user()->id;

        $progress = ($request->initial_target_amount / $request->target_amount) * 100;
        $goalItem = Goal::create($requestData);

        $user = $request->user();

        if ($user->goal_notifications_enabled) {
            // Send GoalDeadlineNotification if deadline is within 3 days
            $deadline = Carbon::parse($goalItem->deadline);
            if (Carbon::now()->diffInDays($deadline) <= 3) {
                Notification::send($request->user(), new GoalDeadlineNotification());
            }
        }

        $goalItem->progress = $progress;
        $goalItem->save();

        return response()->json($goalItem, 201);
    }

    public function show(Request $request, Goal $goal)
    {
        if ($request->user()->id !== $goal->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($goal);
    }

    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'name' => 'required',
            'deadline' => 'required',
            'description'=> 'required' ,
            'status'=>'required',
            'icon' => 'required',
            'target_amount' => 'required',
            'initial_target_amount' =>'required' ,
            'color' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['user_id'] = $request->user()->id;

        $progress = ($request->initial_target_amount / $request->target_amount) * 100;
        $goal->update($requestData);
        $goal->progress = $progress;
        $goal->save();

        return response()->json($goal);
    }
    public function getGoalsByStatus(Request $request, $status)
    {
        $goals = Goal::where('status', $status)
        ->where('user_id', $request->user()->id)
        ->get();
    return response()->json($goals);
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        return response()->json(null, 204);
    }
}
