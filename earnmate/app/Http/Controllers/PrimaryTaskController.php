<?php

namespace App\Http\Controllers;

use App\Models\DonePrimaryTask;
use App\Models\PrimaryTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrimaryTaskController extends Controller
{
    public function create(Request $request)
    {
        $task = new PrimaryTask();
        $task->description = $request->description;
        $task->link = $request->link;
        $task->save();
        return response()->json($task);
    }
    public function add(Request $request)
    {
        
        $task = PrimaryTask::create([
            'description' => $request->description,
            'link' => $request->link ? $request->link : null
        ]);
        return response()->json($task);
    }

    public function confirm(Request $request)
    {
        $done_task = new DonePrimaryTask;
        $done_task->primary_task_id = $request->task_id;
        $done_task->user_id = Auth::user()->id;
        $done_task->status = 'pending';
        if ($request->hasFile('screenshot')) {
            $request_file = $request->file('screenshot');
            $path = '/done_primary_tasks';
            $NewPath = Storage::disk('google')->putFile($path, $request_file);
            $done_task->image = $NewPath;
        }else{
            return response('failure', 201)->json('failed');
        }
        $done_task->save();
        return response()->json('confirmed');
    }
    public function edit_status(Request $request)
    {
        $task  = DonePrimaryTask::find($request->id);
        $task->update([
            'status' => $request->status
        ]);
        Storage::disk('google')->delete($task->image);
        $task->update([
            'image'  => 'no_screenshot'
        ]);
        return response()->json($task); 
    }
    public function delete(Request $request)
    {
        $tasks_ids = $request->tasks;
        if ($tasks_ids && is_array($tasks_ids)) {
            try {
                foreach ($tasks_ids as $id) {
                    PrimaryTask::destroy($id);
                }
                return response(status : 200);
            } catch (\Throwable $th) {
                return response(status: 203)->json($th);
            }
        }
        else{
            return response(status : 201);
        }
    }
}
