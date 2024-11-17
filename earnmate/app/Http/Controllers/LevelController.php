<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function info(Request $request)
    {
        return Level::where('level_number',$request->query('level'))->first();
    }
}
