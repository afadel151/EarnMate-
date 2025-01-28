<?php

namespace App\Http\Controllers;

use App\Models\InviteOffer;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InviteOfferController extends Controller
{
    
    public function create(Request $request)
    {
        $validated = $request->validate([
            'invite' => 'required',
            'reward' => 'required'
        ]);
        $offer = InviteOffer::create($validated);
        return response()->json($offer);
    }

    public function close(Request $request)
    {
        $offer = InviteOffer::find($request->offer_id);
        $offer->update([
            'closed' => true
        ]);
        $users_ids = DB::table('invitation_offers_users')
            ->where('invitation_offer_id', $request->offer_id)
            ->pluck('user_id')->toArray();
        
        foreach ($users_ids as $id) {
            $invited_ids = DB::table('invitation_offers_users')
            ->where('user_id', $id)
            ->pluck('invited_id')->toArray();
            $count = Subscription::whereIn('user_id', $invited_ids)
                    ->groupBy('user_id')
                    ->select('user_id')
                    ->get()
                    ->count();
            if ($count >= $offer->invited) {
                User::find($id)->update([
                    'balance' =>  User::find($id)->balance + $offer->reward
                 ]);
            }
        }
        return response()->json(count($users_ids));
    }
}
