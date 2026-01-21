<?php

namespace App\Http\Controllers;

use App\Models\Sos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        // Write a server-side log for admins / monitoring systems.
        Log::info('SOS created', [
            'user_id' => auth()->id(),
            'province' => $validated['province'] ?? null,
            'lat' => $validated['lat'] ?? null,
            'lng' => $validated['lng'] ?? null,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'SOS received'], 201);
        }

        return back()->with('success', 'SOS berhasil dikirim!');
    }

    /**
     * List SOS entries (for admin/API).
     */
    public function index(Request $request)
    {
        $q = Sos::query()->with('user');

        if ($request->filled('province')) {
            $q->where('province', $request->province);
        }

        $items = $q->orderByDesc('created_at')->paginate(30);

        if ($request->wantsJson()) {
            return response()->json($items);
        }

        return view('admin.sos.index', ['items' => $items]);
    }
}

