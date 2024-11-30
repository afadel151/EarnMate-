<?php

namespace App\Http\Controllers;

use App\Models\DoneTask;
use App\Models\Offer;
use App\Models\Subscription;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $user = Auth::user()->load('deposits');
        $user->current_level = $user->current_level();
        $level = $user->current_level ? $user->current_level->load('level') : $user->current_level;

        $subscriptions = Subscription::all()->pluck('user_id')->toArray();
        $invitedFriends = Auth::user()->friends->whereIn('referenced_id',$subscriptions)->count();
        
        $bonus = $user->bonuses()->sum('amount');
        $donetasks = Auth::user()->tasks()->pluck('task_id')->toArray();
        $remainedtasks = Task::whereNotIn('id',$donetasks)->get();
        $offer = Offer::whereDate('start_date','>=',Carbon::today())->first();
        if ($user->admin()->exists()) {
            return redirect(route('admin.dashboard'));
        }
        $offers = Offer::active()->get();
        return Inertia::render('Dashboard2',[
            'friends' => $invitedFriends,
            'tasks' => $remainedtasks,
            'user' => $user,
            'bonus' => $bonus,
            'offer' => $offer,
            'level' => $level
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function deposits()
    {
        $deposits = Auth::user()->deposits;
        return Inertia::render('Deposits', ['deposits'=>$deposits]);
    }
    public function statistics()
    {
        $tasks = Auth::user()->tasks->load(['task']);
        return Inertia::render('Statistics', ['tasks'=>$tasks]);
    }
    public function withdrawals()
    {
        $withdrawals = Auth::user()->withdrawals;
        return Inertia::render('Withdrawals', ['withdrawals'=>$withdrawals]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function leaderboard()
    {
        return Inertia::render('LeaderBoard');
    }
    public function tasks()
    {
        $donetasks = Auth::user()->tasks;
        $donetasks->load('task');
        return Inertia::render('Tasks',['tasks'=>$donetasks]);
    }
    public function bonuses()
    {
        $bonuses = Auth::user()->bonuses->load('friend');
        return Inertia::render('Bonuses',['bonuses'=>$bonuses]);
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
