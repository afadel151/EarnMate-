<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Config;
use App\Models\Deposit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DepositController extends Controller
{
    public function getrip():JsonResponse
    {
        $respose = new \stdClass;
        
        $admins = Admin::all();
        foreach ($admins  as $admin) {
            if ($admin->baridi_balance < Config::find(1)->max_balance) {
                $respose->rip = $admin->RIP;
                $respose->admin_id = $admin->id;
                return response()->json($respose);
            }
        }
        return response()->json('full');
    }
    public function baridi(Request $request): JsonResponse    
    {
        $request->validate([
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'screenshot' => 'required',
            'transaction_code' => 'required|numeric'
        ]);
        $deposit = new Deposit;
        $deposit->user_id = Auth::user()->id;
        $deposit->admin_id = $request->admin_id;
        $deposit->method = 'baridi';
        $amount = $request->input('amount');    
        $deposit->amount = $amount;
        $deposit->price = $request->price;
        $deposit->transaction_code = $request->transaction_code;
        if ($request->hasFile('screenshot')) {
            $request_file = $request->file('screenshot');
            $path = '/baridi';
            $NewPath = Storage::disk('local')->putFile($path, $request_file);
            $deposit->screenshot = $NewPath;
        }else{
            $deposit->screenshot = 'no_screenshot';
        }
        $deposit->save();
        return response()->json('done');
    }
    public function binance(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'screenshot' => 'required|string',
        ]);
        $deposit = new Deposit;
        $deposit->user_id = Auth::user()->id;
        $deposit->admin_id = $request->admin_id;
        $deposit->method = 'binance';
        $amount = $request->input('amount');    
        $deposit->amount = $amount;
        $deposit->transaction_code = 'no_code';
        if ($request->hasFile('screenshot')) {
            $request_file = $request->file('screenshot');
            $path = '/binance';
            $NewPath = Storage::disk('local')->putFile($path, $request_file);
            $deposit->screenshot = $NewPath;
        }else{
            $deposit->screenshot = 'no_screenshot';
        }
        $deposit->save();
        return response()->json($deposit);
    }
    public function bybit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'screenshot' => 'required|string',
        ]);
        $deposit = new Deposit;
        $deposit->user_id = Auth::user()->id;
        $deposit->admin_id = $request->admin_id;
        $deposit->method = 'bybit';
        $amount = $request->input('amount');    
        $deposit->amount = $amount;
        $deposit->transaction_code = 'no_code';
        if ($request->hasFile('screenshot')) {
            $request_file = $request->file('screenshot');
            $path = '/bybit';
            $NewPath = Storage::disk('local')->putFile($path, $request_file);
            $deposit->screenshot = $NewPath;
        }else{
            $deposit->screenshot = 'no_screenshot';
        }
        $deposit->save();
        return response()->json($deposit);
    }
    public function edit_status(Request $request)
    {
        $deposit = Deposit::find($request->id);
        $old_status = $deposit->status;

        $deposit->update([
            'status' => $request->status
        ]);
        Storage::disk('local')->delete($deposit->screenshot);
        $deposit->update([
            'screenshot'  => 'no_screenshot'
        ]);
        $user = $deposit->user;
        if ($request->status == 'confirmed' ) {
            if ($old_status == 'pending') {
                if ($deposit->method == 'baridi') {
                    $newbalance = $user->balance + $deposit->amount - $deposit->amount*Config::find(1)->baridi_percentage/100;
                    \Log::info($newbalance);
                    $user->update([
                        'balance' => $newbalance
                    ]);
                    $deposit->admin->update([
                        'baridi_balance' => $deposit->admin->baridi_balance +  $deposit->amount
                    ]);
                }else{
                    $newbalance = $user->balance + $deposit->amount - $deposit->amount * Config::find(1)->binance_percentage / 100;
                    \Log::info($newbalance);
                    $user->update([
                        'balance' => $newbalance
                    ]);
                    $deposit->admin->update([
                        'binance_balance' => $deposit->admin->binance_balance +  $deposit->amount
                    ]);
                }
                
            }else{
                return response()->json($deposit);
            }
        }
        return response()->json($deposit);   
    }
}
