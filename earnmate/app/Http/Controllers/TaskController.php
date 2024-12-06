<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DoneTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function confirm(Request $request)
    {
        $done_task = new DoneTask;
        $done_task->task_id = $request->task_id;
        $done_task->user_id = Auth::user()->id;
        $admins = Admin::all();
        $tasks = 1200000;
        $admin_id = 0;
        foreach ($admins as $admin) {
            $t = $admin->done_tasks()->whereDate('created_at', Carbon::today())->count();
            if ($t <= $tasks) {
                $tasks = $t;
                $admin_id = $admin->id;
            }
        }
        $done_task->admin_id = $admin_id;
        $done_task->status = 'pending';
        if ($request->hasFile('screenshot')) {
            $request_file = $request->file('screenshot');
            $path = '/done_tasks';
            $NewPath = Storage::disk('local')->putFile($path, $request_file);
            $done_task->image = $NewPath;
        }else{
            // $done_task->image = 'no_screenshot';
            return response('failure', 201)->json('failed');
        }
        $done_task->save();
        return response()->json('confirmed');
    }
    public function edit_status(Request $request)
    {
        $task  = DoneTask::find($request->id);
        $task->update([
            'status' => $request->status
        ]);
        Storage::disk('local')->delete($task->image);
        $task->update([
            'image'  => 'no_screenshot'
        ]);
        return response()->json($task);   
    }
}
