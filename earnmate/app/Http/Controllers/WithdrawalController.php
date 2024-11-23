<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Withdrawal;
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
}
