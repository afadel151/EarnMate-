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
        $admins = Admin::all();
        foreach ($admins  as $admin) {
            if ($admin->balance < 200000) {
                $deposit->admin_id = $admin->id;
                break;
            }
        }
        $amount = $request->input('amount');    
        $deposit->amount = $amount;
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
        $deposit->update([
            'status' => $request->status
        ]);
        return response()->json($deposit);   
    }
}
