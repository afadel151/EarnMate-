<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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

    }
    public function withdrawals() {

    }
    public function tasks(){

    }
    public function offers(){
        
    }
    public function messages(){
        
    }
    public function show($id){
        if (Admin::where('user_id',$id)->exists()) {
            return Inertia::render('Admin/Show',['admin'=>User::find($id)->load('admin')]);
        }
        
    }
}
