<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Subscription;
use Auth;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function info(Request $request)
    {
        $level = Level::where('level_number',$request->query('level'))->first();
        $next = Level::find($level->id + 1);
        $infos = new \stdClass;
        $infos->level = $level;
        $infos->next = $next;
        $subscriptions = Subscription::all()->pluck('user_id')->toArray();
        $invitedFriends = Auth::user()->friends->whereIn('referenced_id',$subscriptions)->count();
        $infos->active_friends = $invitedFriends;
        return response()->json($infos);
    }
}
