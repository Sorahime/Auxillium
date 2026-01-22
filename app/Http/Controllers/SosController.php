<?php

namespace App\Http\Controllers;

use App\Models\Sos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SosController extends Controller
{
    /**
     * Show form for creating a new SOS alert
     */
    public function create()
    {
        return view('sos.create');
    }

    /**
     * Store a newly created SOS alert
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ]);

        $sos = Sos::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'description' => $validated['description'],
            'location' => $validated['location'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'status' => 'active',
        ]);

        // Write a server-side log for admins / monitoring systems
        Log::info('SOS Alert created', [
            'sos_id' => $sos->id,
            'user_id' => auth()->id(),
            'location' => $validated['location'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'SOS received', 'id' => $sos->id], 201);
        }

        return redirect('/dashboard')->with('success', 'SOS Alert berhasil dikirim! Admin sedang menuju lokasi Anda.');
    }

    /**
     * List SOS entries for user
     */
    public function myAlerts()
    {
        $alerts = auth()->user()->sosAlerts()->latest()->paginate(10);
        return view('sos.my-alerts', compact('alerts'));
    }

    /**
     * Show single SOS alert detail
     */
    public function show(Sos $sos)
    {
        // Check if user owns this alert or is admin
        if (auth()->id() !== $sos->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('sos.show', compact('sos'));
    }

    /**
     * List SOS entries (for admin/API).
     */
    public function index(Request $request)
    {
        $q = Sos::query()->with('user');

        if ($request->filled('status')) {
            $q->where('status', $request->status);
        }

        $items = $q->orderByDesc('created_at')->paginate(30);

        if ($request->wantsJson()) {
            return response()->json($items);
        }

        return view('admin.sos.index', ['items' => $items]);
    }
}

