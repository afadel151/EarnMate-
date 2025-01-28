<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferSubscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class OfferController extends Controller
{
    public function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'start_date'=> 'required',
            'start_time'=> 'required',
            'days'=> 'required',
            'real_max_users'=> 'required',
            'fake_max_users'=> 'required',
            'required_amount'=> 'required',
            'percentage'=> 'required',
            'method'=> 'required'
        ]);
        $offer = Offer::create($validated);
        return response()->json($offer);
    }
    public function can(Request $request)
    {
        
        $offer_id = $request->get('offer_id');
        if (OfferSubscription::where('user_id',Auth::user()->id)->where('offer_id',$offer_id)->exists()) {
            return response()->json(OfferSubscription::where('user_id',Auth::user()->id)->where('offer_id',$offer_id)->first()->status);
        }
        $subscribers = OfferSubscription::where('offer_id',$offer_id)->count();
        if ($subscribers < Offer::find($offer_id)->real_max_users) {
            return response()->json(true);
        }else {
            return response()->json(false);
        }
    }

    public function baridi(Request $request)
    {
        $subscription = new OfferSubscription;
        $subscription->user_id = Auth::user()->id;
        $subscription->offer_id = $request->offer_id;
        $subscription->admin_id = $request->admin_id;
        $subscription->method = 'baridi';
        $subscription->transaction_code = $request->code;
    
        $subscription->amount = $request->amount;
        $subscription->status = 'pending';
        if ($request->hasFile('screenshot')) {
            $request_file = $request->file('screenshot');
            $path = '/baridi';
            $NewPath = Storage::disk('google')->putFile($path, $request_file);
            $subscription->screenshot = $NewPath;
        }else{
            $subscription->screenshot = 'no_screenshot';
        }
        $subscription->save();
        return response()->json('done');

    }
    public function binance(Request $request)
    {
        $subscription = new OfferSubscription;
        $subscription->user_id = Auth::user()->id;
        $subscription->offer_id = $request->offer_id;
        $subscription->admin_id = 1;
        $subscription->method = 'binance';
        $subscription->transaction_code = '0000';
        $subscription->amount = $request->amount;
        $subscription->status = 'pending';
        if ($request->hasFile('screenshot')) {
            $request_file = $request->file('screenshot');
            $path = '/binance';
            $NewPath = Storage::disk('google')->putFile($path, $request_file);
            $subscription->screenshot = $NewPath;
        }else{
            $subscription->screenshot = 'no_screenshot';
        }
        $subscription->save();
        return response()->json('done');
    }
    public function bybit(Request $request)
    {
        $subscription = new OfferSubscription;
        $subscription->user_id = Auth::user()->id;
        $subscription->offer_id = $request->offer_id;
        $subscription->admin_id = 1;
        $subscription->method = 'bybit';
        $subscription->transaction_code = '0000';
        $subscription->status = 'pending';
        if ($request->hasFile('screenshot')) {
            $request_file = $request->file('screenshot');
            $path = '/bybit';
            $NewPath = Storage::disk('google')->putFile($path, $request_file);
            $subscription->screenshot = $NewPath;
        }else{
            $subscription->screenshot = 'no_screenshot';
        }
        $subscription->save();
        return response()->json('done');
    }

    public function edit_status(Request $request)
    {
        $sub = OfferSubscription::find($request->id);
        $sub->update([
            'status' => $request->status
        ]);
        if ($sub->screenshot != 'no_screenshot') {
            Storage::disk('google')->delete($sub->screenshot);
        }else {
            
            $sub->update([
                'screenshot'  => 'no_screenshot'
            ]);
        }
        return response()->json($sub);
    }
    public function subscribers()
    {

        $subscriptions = OfferSubscription::all()->load(['user','offer']);
        return Inertia::render('Admin/OfferSubscriptions',[
            'subscriptions' => $subscriptions
        ]);
    }

    public function offers()
    {
        $subscriptions = Auth::user()->offers->load('offer');
        return Inertia::render('Offers', [
            'subscriptions' => $subscriptions
        ]);
    }    
}

