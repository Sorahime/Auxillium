<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Profile;

class FrontController extends Controller
{
     public function home() {
        return view('front.home');
    }

    public function news(Request $request) {
        $query = News::query();
        
        // Only show published news to public
        $query->where('status', 'published');

        // search title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        // filter disaster type
        if ($request->filled('type')) {
            $query->where('disaster_type', $request->type);
        }

        $news = $query->orderByDesc('created_at')->paginate(12)->withQueryString();

        return view('front.news', [
            'news' => $news,
            'filters' => [
                'search' => $request->search,
                'type' => $request->type,
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
