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
            return response()->json(Task::all()->load('admin.user')->toArray());
        }else {
            return response('error',400);
        }
    }
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required',
            'platform' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);
        $task = Task::create([
            'name' => $validatedData['name'],
            'link' => $validatedData['link'],
            'platform' => $validatedData['platform'],
            'type' => $validatedData['type'],
            'admin_id' => Admin::where('user_id', Auth::id())->first()->id,
        ]);
        $task->load('admin.user');
        return response()->json($task);
    }

    
}
