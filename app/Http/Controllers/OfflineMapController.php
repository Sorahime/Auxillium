<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfflineMap;

class OfflineMapController extends Controller
{
    public function index()
    {
        $items = OfflineMap::orderByDesc('downloaded_at')->get();

        if (request()->wantsJson()) {
            return response()->json(['data' => $items]);
        }

        return view('front.offline-maps', [
            'items' => $items
        ]);
    }
}
