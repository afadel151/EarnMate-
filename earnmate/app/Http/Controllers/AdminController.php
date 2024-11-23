<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Deposit;
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
        return Inertia::render('Admin/Admins');
    }
    public function users()
    {
        return Inertia::render('Admin/Users');
    }
    public function show($id){
        if (Admin::where('user_id',$id)->exists()) {
            return Inertia::render('Admin/Show',['admin'=>User::find($id)->load('admin')]);
        }
        
    }
}
