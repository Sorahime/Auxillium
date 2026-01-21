<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfflineMapController extends Controller
{
    public function index()
    {
        return view('front.offline-maps', [
            'items' => []
        ]);
    }
}
