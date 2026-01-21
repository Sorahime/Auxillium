<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Sos;
use App\Models\Report;
use App\Models\OfflineMap;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function news(Request $request)
    {
        $query = News::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $news = $query->orderByDesc('published_at')->paginate(20);

        return response()->json($news);
    }

    public function sos(Request $request)
    {
        $q = Sos::query()->with('user');
        if ($request->filled('province')) {
            $q->where('province', $request->province);
        }
        $items = $q->orderByDesc('created_at')->paginate(30);
        return response()->json($items);
    }

    public function reports(Request $request)
    {
        $q = Report::query()->with('user');
        if ($request->filled('province')) {
            $q->where('province', $request->province);
        }
        $items = $q->orderByDesc('created_at')->paginate(30);
        return response()->json($items);
    }

    public function offlineMaps(Request $request)
    {
        $items = OfflineMap::orderByDesc('downloaded_at')->paginate(30);
        return response()->json($items);
    }

    public function downloadOfflineMap(Request $request, $id)
    {
        $map = OfflineMap::findOrFail($id);

        // If file_path field exists on model, serve file; fallback to 404
        if (isset($map->file_path) && $map->file_path && Storage::disk('public')->exists($map->file_path)) {
            return Storage::disk('public')->download($map->file_path);
        }

        return response()->json(['error' => 'File not available'], 404);
    }
}
