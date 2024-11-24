<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $invitedFriends = Auth::user()->friends();
        
        return Inertia::render('Dashboard2',[
            'friends' => $invitedFriends->count()
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
            return Inertia::render('Statistics');
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
        //
    }
    public function tasks()
    {
        //
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
