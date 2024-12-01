<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Deposit;
use App\Models\DoneTask;
use App\Models\Level;
use App\Models\Offer;
use App\Models\Reference;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard() {
        $admin = Admin::where('user_id', Auth::user()->id)->first();
        $admins = Admin::all()->take(6);
        $admins->load('user');
        $levels = Level::all();
        foreach ($levels as $level) {
            $level->users_count = $level->subscriptions()->where('completed',false)->count();
        }
        $users_count = User::all()->count();
        $users_today = User::where('created_at','=',Carbon::today())->count();
        $invitations_count = Reference::all()->count();
        $invitations_today = Reference::whereDate('created_at','=',Carbon::today())->count();
        $deposits_sum = $admin->deposits()->where('status', 'confirmed')->sum('amount');
        $today_deposits_sum = Deposit::whereDate('created_at', '=', Carbon::today())->sum('amount');
        $withdrawals_sum = $admin->withdrawals()->where('status', 'completed')->sum('amount');
        $today_withdrawals_sum = Withdrawal::whereDate('created_at', '=', Carbon::today())->sum('amount');
        $users_by_methods = Deposit::select('method', DB::raw('COUNT(DISTINCT user_id) as user_count'))
                            ->groupBy('method')
                            ->get();

        return Inertia::render('Admin/Dashboard', [
                    'admin' => $admin,
                    'admins' => $admins,
                    'levels' => $levels,
                    'users_count' => $users_count,
                    'users_today'=> $users_today,
                    'invitations_count' => $invitations_count,
                    'invitations_today' => $invitations_today,
                    'deposits_sum' => $deposits_sum,
                    'today_deposits_sum' => $today_deposits_sum,
                    'withdrawals_sum' => $withdrawals_sum,
                    'today_withdrawals_sum' => $today_withdrawals_sum,
                    'users_by_method' => $users_by_methods
                ]);
        }
    public function profile(Request $request){
        return Inertia::render('Admin/Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
    public function deposits() {
        $deposits = Deposit::where('admin_id',Admin::where('user_id',Auth::user()->id)->first()->id)->orderBy('created_at')->get();
        return Inertia::render('Admin/Deposits', ['deposits'=>$deposits]);
    }
    public function withdrawals() {
        return Inertia::render('Admin/Withdrawals');

    }
    public function tasks(){
        return Inertia::render('Admin/Tasks');

    }
    public function offers(){
        $offers = Offer::all();
        return Inertia::render('Admin/Offers',[
            'offers' => $offers
        ]);

    }
    public function messages(){
        return Inertia::render('Admin/Messages');

    }
    public function leaderboard(){
        return Inertia::render('Admin/LeaderBoard');
    }
    public function admins()
    {
        $admins = Admin::all()->load('user');
        return Inertia::render('Admin/Admins', ['admins' => $admins]);
    }
    public function users()
    {
        $users = User::with(['tasks', 'friends', 'bonuses', 'subscriptions'])->get();
        foreach ($users as $user) {
            $user->current_level = $user->current_level();
            $user->current_level ? $user->current_level->load('level') : $user->current_level; // Assign method output to a temporary attribute
        }
        return Inertia::render('Admin/Users', ['users'=>$users]);
    }
    public function show($id){
        if (Admin::where('user_id',$id)->exists()) {
            return Inertia::render('Admin/Show',['admin'=>User::find($id)->load('admin')]);
        }
    }
    public function done_tasks()
    {
        $tasks = Auth::user()->admin->done_tasks->load(['task', 'user']);
        return Inertia::render('Admin/DoneTasks', ['tasks'=> $tasks]);
    }
    public function add(Request $request)
    {
        $email = $request->email;
        $RIP = $request->RIP;
        $user_id = User::where('email', $email)->first()->id;
        $admin = Admin::create([
            'user_id'=> $user_id,
            'RIP' => $RIP,
            'balance' => 0.00
        ]);
        $admin->load('user');
        return response()->json($admin);
    }

    public function user($id)
    {
        $user = User::find($id)->load(['withdrawals','subscriptions','deposits','tasks','friends','bonuses','offers']);
        return Inertia::render('Admin/User',[
            'user' => $user
        ]);
    }
}
