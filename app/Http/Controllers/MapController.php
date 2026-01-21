<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function show($province)
    {
        return view('front.map', [
            'province' => urldecode($province),
        ]);
    }
}
