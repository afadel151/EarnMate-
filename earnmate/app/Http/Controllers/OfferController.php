<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $offer = Offer::creat($validated);
    }
}

