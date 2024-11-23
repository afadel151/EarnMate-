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
        $withdrawals = Withdrawal::where('admin_id',$admin_id)->get()->load('admin.user', 'user')->toArray();
        return response()->json($withdrawals);
    }
    public function withdraw_baridi(Request $request)
    {
        $rip = $request->rip;
        $amount = $request->amount;

       
        if (Auth::user()->balance < $amount) {
            return response()->json('failed');
        }
        $withdrawal = new Withdrawal;
        $withdrawal->destination = $rip;
        $withdrawal->method = 'baridi';
        $withdrawal->amount = $amount;
        $withdrawal->user_id = Auth::user()->id;
        $withdrawal->processed_at = Carbon::now();
        $admins = Admin::all();
        foreach ($admins as $admin) {
            $amounts = $admin->withdrawals()->whereDate('created_at', Date::today())
                            ->sum('amount');
            if ($amounts < 200000) {
                $withdrawal->admin_id = $admin->id;
                $withdrawal->status = 'pending';
                $withdrawal->save();
                return response()->json($withdrawal);
            }
        }
        return response()->json('failed');

    }
}
