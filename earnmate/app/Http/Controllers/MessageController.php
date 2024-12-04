<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index(){
        $messages = Auth::user()->messages;
        return Inertia::render('Messages',[
            'messages' => $messages
        ]);
    }

    public function user($id)
    {
        $messages = Message::where('user_id',$id)->orderByDesc('id')->get();
        $user = User::find($id);
        return Inertia::render('Admin/Conversation',[
            'messages' => $messages,
            'user' => $user
        ]);
    }
    public function add_admin(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'message' => 'required'
        ]);
        $user_id = $request->user_id;
        $message = $request->message;
        $message = Message::create([
            'user_id' => $user_id,
            'message' => $message,
            'sender' => 'admin'
        ]);
        return response()->json( $message);
    }
    public function add_user(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'message' => 'required'
        ]);
        $user_id = $request->user_id;
        $message = $request->message;
        $message = Message::create([
            'user_id' => $user_id,
            'message' => $message,
            'sender' => 'user'
        ]);
        return response()->json($message);
    }
    public function get_conversations(): JsonResponse
    {
        $users_ids =  Message::selectRaw('user_id')
                ->groupBy('user_id')
                ->pluck('user_id')
                ->toArray();
        $users = User::whereIn('id',$users_ids)->get();
        return response()->json($users);
    }
}
