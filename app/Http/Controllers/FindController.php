<?php

namespace App\Http\Controllers;

use App\Point;
use Illuminate\Http\Request;

class FindController extends Controller
{
    public function find(Request $request)
    {
        $points = Point::where('name', 'like', '%'.$request->name.'%')->get();

        return \App\Http\Resources\Point::collection($points);
    }
}
