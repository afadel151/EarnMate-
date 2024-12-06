<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConfigController extends Controller
{
    public function config()
    {
        $config = Config::find(1);
        return Inertia::render('Admin/Config',[
            'config' => $config
        ]);
    }
    public function edit(Request $request)
    {
        $config = Config::find(1);
        $config->update([
            'max_balance'=> $request->max_balance,
            'level_days'=> $request->level_days,
            'baridi_tax_percentage'=> $request->baridi_tax_percentage,
            'binance_tax_percentage'=> $request->binance_tax_percentage,
            'dzd_price'=> $request->dzd_price,
        ]);
        return response()->json('done');
    }
}
