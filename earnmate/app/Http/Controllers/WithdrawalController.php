<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function get(Request $request)
    {
        $admin_id = Admin::where('user_id', Auth::user()->id)->first()->id;
        $withdrawals = Withdrawal::where('admin_id',$admin_id)->get()->sortByDesc('created_at')->load('admin.user', 'user')->toArray();
        return response()->json($withdrawals);
    }
    public function withdraw_baridi(Request $request)
    {
        $rip = $request->rip;
        $amount = $request->amount;
        $price = $request->price;
        if (Auth::user()->balance < $amount) {
            return response()->json('failed');
        }
        $withdrawal = new Withdrawal;
        $withdrawal->destination = $rip;
        $withdrawal->method = 'baridi';
        $withdrawal->amount = $amount;
        $withdrawal->user_id = Auth::user()->id;
        $withdrawal->price = $price;
        $withdrawal->processed_at = Carbon::now();
        $admins = Admin::all();
        $done = false;
        foreach ($admins as $admin) {
            $amounts = $admin->withdrawals()->whereDate('created_at', Date::today())
                            ->sum('amount');
            if ($amounts < 200000) {
                $done = true;
                $withdrawal->admin_id = $admin->id;
                $withdrawal->status = 'pending';
                $withdrawal->save();
                return response()->json($withdrawal);
            }
        }
        return response()->json('failed');
    }
    public function withdraw_binance(Request $request)
    {
        $adress = $request->adress;
        $amount = $request->amount;
        if (Auth::user()->balance < $amount) {
            return response()->json('failed');
        }
        $withdrawal = new Withdrawal;
        $withdrawal->destination = $adress;
        $withdrawal->method = 'binance';
        $withdrawal->amount = $amount;
        $withdrawal->user_id = Auth::user()->id;
        $withdrawal->processed_at = Carbon::now();
        $withdrawal->admin_id = 1;
        $withdrawal->status = 'pending';
        $withdrawal->save();
        return response()->json($withdrawal);
    }
    public function withdraw_bybit(Request $request)
    {
        $adress = $request->adress;
        $amount = $request->amount;
        if (Auth::user()->balance < $amount) {
            return response()->json('failed');
        }
        $withdrawal = new Withdrawal;
        $withdrawal->destination = $adress;
        $withdrawal->method = 'bybit';
        $withdrawal->amount = $amount;
        $withdrawal->user_id = Auth::user()->id;
        $withdrawal->processed_at = Carbon::now();
        $withdrawal->admin_id = 1;
        $withdrawal->status = 'pending';
        $withdrawal->save();
        return response()->json($withdrawal);
    }
    public function edit_status(Request $request)
    {
        $withdrawal = Withdrawal::find($request->id);
        $status = $withdrawal->status;
        if ($status == 'pending') {
            $withdrawal->update([
                'status' => $request->status
            ]);
            if ($request->status == 'completed') {
                $user = $withdrawal->user;
                $user->update([
                    'balance' => $user->balance - $withdrawal->amount
                ]);
                if ($withdrawal->method == 'baridi') {
                    $withdrawal->admin->update([
                        'baridi_balance' => $withdrawal->admin->baridi_balance -  $withdrawal->amount
                    ]);
                }else {
                    $withdrawal->admin->update([
                        'binance_balance' => $withdrawal->admin->binance_balance -  $withdrawal->amount
                    ]);
                }
                
            }
        }
        return response()->json($withdrawal);   
    }
}
