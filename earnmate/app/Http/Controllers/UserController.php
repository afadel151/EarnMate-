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
    public function deposit()
    {
            return Inertia::render('Deposit');
    }
    public function statistics()
    {
            return Inertia::render('Statistics');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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