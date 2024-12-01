<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
            if ($admin->balance < 200000) {
                $respose->rip = $admin->RIP;
                $respose->admin_id = $admin->id;
                return response()->json($respose);
            }
        }
        return response()->json('full');
    }
    public function baridi(Request $request): JsonResponse    
    {
        $deposit = new Deposit;
        $deposit->user_id = Auth::user()->id;
        $deposit->admin_id = $request->admin_id;
        $amount = $request->input('amount');    
        $deposit->amount = $amount;
        $deposit->price = $request->price;
        $deposit->transaction_code = $request->code;
        if ($request->hasFile('screenshot')) {
            $request_file = $request->file('screenshot');
            $path = '/baridi';
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
                    $newbalance = $user->balance + $deposit->amount - $deposit->amount*10/100;
                    $user->update([
                        'balance' => $newbalance
                    ]);
                }else{
                    $newbalance = $user->balance + $deposit->amount - $deposit->amount * 3 / 100;
                    $user->update([
                        'balance' => $newbalance
                    ]);
                }
            }else{
                return response()->json($deposit);
            }
        }
        return response()->json($deposit);   
    }
}
