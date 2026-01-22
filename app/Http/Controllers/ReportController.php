<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show form for creating a new report
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created report
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'disaster_type' => ['required', 'string', 'in:earthquake,flood,landslide,tsunami,tornado,hurricane,wildfire,volcano,drought,other'],
            'location' => ['required', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'], // 5MB
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('reports', 'public');
        }

        Report::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'disaster_type' => $validated['disaster_type'],
            'location' => $validated['location'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'photo_path' => $photoPath,
            'status' => 'pending',
        ]);

        return redirect('/dashboard')->with('success', 'Laporan bencana berhasil dikirim! Admin akan memeriksa laporan Anda.');
    }

    /**
     * Show user's reports
     */
    public function myReports()
    {
        $reports = auth()->user()->reports()->latest()->paginate(10);
        return view('reports.my-reports', compact('reports'));
    }

    /**
     * Show single report detail
     */
    public function show(Report $report)
    {
        // Check if user owns this report or is admin
        if (auth()->id() !== $report->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('reports.show', compact('report'));
    }
}

