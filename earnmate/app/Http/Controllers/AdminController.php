<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Deposit;
use App\Models\DoneTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard() {
        return Inertia::render('Admin/Dashboard');
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
        return Inertia::render('Admin/Offers');

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
        // $users = User::all()->load(['tasks','friends','bonuses','subscriptions', 'current_level']);
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
}
