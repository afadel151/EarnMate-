<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\DoneTask;
use App\Models\Offer;
use App\Models\Subscription;
use App\Models\Task;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $user = Auth::user()->load('deposits');
        $level = $user->current_level ;

        $subscriptions = Subscription::all()->pluck('user_id')->toArray();
        $invitedFriends = Auth::user()->friends->whereIn('referenced_id',$subscriptions)->count();
        
        $bonus = $user->bonuses()->sum('amount');
        $donetasks = Auth::user()->tasks()->pluck('task_id')->toArray();
        $remainedtasks = Task::whereNotIn('id',$donetasks)->whereDate('created_at',Carbon::today())->get();
        $offer = Offer::whereDate('start_date','>=',Carbon::today())->first();
        if ($user->admin()->exists()) {
            return redirect(route('admin.dashboard'));
        }
        return Inertia::render('Dashboard2',[
            'friends' => $invitedFriends,
            'tasks' => $remainedtasks,
            'user' => $user,
            'bonus' => $bonus,
            'offer' => $offer,
            'level' => $level
        ]);
    }

    public function help()
    {
        return Inertia::render('Help');
    }
    public function getDzdPrice()
    {
        return response()->json(['price' => Config::find(1)->dzd_price]);
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
        $users = User::all()->load('friends');
        foreach ($users as $user) {
                $withdrawedAmount = $user->withdrawals()
                    ->where('status', 'completed') 
                    ->sum('amount'); 

                $user->withdrawed = $withdrawedAmount ?? 0; 
            }
            $users = $users->sortByDesc('withdrawed')->values()->take(100);
            return Inertia::render('LeaderBoard', [
                'users' => $users,
            ]
        );
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
    public function getUserWeeklyWithdrawals()
    {
        $userId = Auth::user()->id; 
        
        $withdrawals = Withdrawal::where('user_id', $userId)
            ->where('status', 'completed') // Only completed withdrawals
            ->selectRaw('YEARWEEK(created_at) as week, SUM(amount) as total')
            ->groupBy('week')
            ->orderBy('week', 'asc')
            ->get();

        $formattedWithdrawals = $withdrawals->map(function ($withdrawal) {
            $weekStart = Carbon::now()->startOfWeek()->setISODate(substr($withdrawal->week, 0, 4), substr($withdrawal->week, 4));
            $weekEnd = $weekStart->copy()->endOfWeek();

            return [
                'week' => $weekStart->format('Y-m-d') . ' to ' . $weekEnd->format('Y-m-d'),
                'total' => $withdrawal->total,
            ];
        });

        return response()->json($formattedWithdrawals);
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
