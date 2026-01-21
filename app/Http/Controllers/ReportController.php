<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
            'province' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:150'],
            'media' => ['nullable', 'file', 'mimes:jpg,jpeg,png,mp4', 'max:15360'], // 15MB
        ]);

        $mediaPath = null;

        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('reports', 'public');
        }

        Report::create([
            'user_id' => auth()->id(),
            'category' => $validated['category'],
            'description' => $validated['description'] ?? null,
            'province' => $validated['province'] ?? null,
            'location' => $validated['location'] ?? null,
            'media_path' => $mediaPath,
        ]);

        return back()->with('success', 'Report berhasil dikirim!');
    }
}
