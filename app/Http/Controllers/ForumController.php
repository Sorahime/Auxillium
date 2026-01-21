<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function show($province)
    {
        return view('front.forum', [
            'province' => urldecode($province),
        ]);
    }
}
