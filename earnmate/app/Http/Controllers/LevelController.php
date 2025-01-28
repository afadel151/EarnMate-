<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Level;
use App\Models\Subscription;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $invitedFriends = Auth::user()->friends()?->whereIn('referenced_id',$subscriptions)->count();
        $infos->active_friends = $invitedFriends;
        return response()->json($infos);
    }
    public function subscribe(Request $request)
    {
        $user = $user = User::find(Auth::user()->id);
        $level = Level::find($request->level_id);
        if ($user->current_level != 'No_subscription') {
            return response()->json('already_subscribed');
        }
        if ($request->method == 'regular') {
            if ($user->balance < $level->deposit_required) {
                return response()->json('insufficient_balance');
            }
            $subscriptions = Subscription::all()->pluck('user_id')->toArray();
            $activeFriends = Auth::user()->friends->whereIn('referenced_id',$subscriptions)->count();
            if ($activeFriends >= $level->friends_required) {
                DB::transaction(function () use ($user, $level) {
                    $subscription = new Subscription;
                    $subscription->user_id = $user->id;
                    $subscription->level_id = $level->id;
                    $subscription->save();
                    $user->balance = $user->balance - $level->deposit_required;
                   
                    $user->save();
                });
                if (!Bonus::where('friend_id',$user->id)->exists() && $user->inviter != 'No_inviter') {
                    Bonus::create([
                        'user_id' => $user->inviter->id,
                        'friend_id' => $user->id,
                        'amount' => $level->required_amount*10/100
                    ]);
                    $inviter = User::find($user->inviter->id);
                    $inviter->update([
                        'balance' => $inviter->balance + $level->required_amount*10/100
                    ]);
                }
                return response()->json('subscribed');
            } else {
                return response()->json('less_friends');
            }
        }else{
            $nextLevel = Level::find($level->id + 1);
            if ($user->balance < $nextLevel->deposit_required) {
                return response()->json('insufficient_balance');
            }
            $subscriptions = Subscription::all()->pluck('user_id')->toArray();
            $activeFriends = Auth::user()->friends->whereIn('referenced_id',$subscriptions)->count();
            $subscriptions = new Subscription;
            $subscriptions->user_id = $user->id;
            $subscriptions->level_id = $level->id;
            $subscriptions->save();
            $user->balance = $user->balance - $nextLevel->deposit_required;
            $user->save();
            return response()->json('subscribed');
            
        }
    }
}
