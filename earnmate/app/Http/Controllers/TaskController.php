<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function gettasks(Request $request)
    {
        if (Admin::where('user_id',Auth::user()->id)->exists()) {
            return response()->json(Task::all()->toArray());
        }else {
            return response('error',400);
        }
    }
}
