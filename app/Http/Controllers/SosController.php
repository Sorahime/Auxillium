<?php

namespace App\Http\Controllers;

use App\Models\Sos;
use Illuminate\Http\Request;

class SosController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => ['nullable', 'string', 'max:500'],
            'province' => ['nullable', 'string', 'max:50'],
            'lat' => ['nullable', 'numeric'],
            'lng' => ['nullable', 'numeric'],
        ]);

        Sos::create([
            'user_id' => auth()->id(),
            'message' => $validated['message'] ?? 'SOS Emergency!',
            'province' => $validated['province'] ?? null,
            'lat' => $validated['lat'] ?? null,
            'lng' => $validated['lng'] ?? null,
        ]);

        return back()->with('success', 'SOS berhasil dikirim!');
    }
}

