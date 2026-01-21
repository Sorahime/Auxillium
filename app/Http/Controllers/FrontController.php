<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class FrontController extends Controller
{
     public function home() {
        return view('front.home');
    }

    public function news() {
     
        $query = News::query();

        // search title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        // filter disaster type
        if ($request->filled('type')) {
            $query->where('disaster_type', $request->type);
        }

        // filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // filter date range preset
        if ($request->filled('date')) {
            if ($request->date === 'today') {
                $query->whereDate('published_at', now()->toDateString());
            } elseif ($request->date === '24h') {
                $query->whereDate('published_at', '>=', now()->subDay()->toDateString());
            } elseif ($request->date === '7d') {
                $query->whereDate('published_at', '>=', now()->subDays(7)->toDateString());
            } elseif ($request->date === '30d') {
                $query->whereDate('published_at', '>=', now()->subDays(30)->toDateString());
            }
        }

        $news = $query->orderByDesc('published_at')->paginate(12)->withQueryString();

        return view('front.news', [
            'news' => $news,
            'filters' => [
                'search' => $request->search,
                'type' => $request->type,
                'status' => $request->status,
                'date' => $request->date,
            ],
        ]);
    }

    public function service() {
        return view('front.service');
    }

    public function profile() {
        $profile = Profile::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'full_name' => auth()->user()->name,
                'username' => auth()->user()->name,
                'email' => auth()->user()->email,
            ]
        );
        return view('front.profile', compact('profile'));
    }
}
