<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Report;
use App\Models\Sos;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{
    /**
     * Show admin dashboard with statistics
     */
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalReports = Report::count();
        $totalSos = Sos::count();
        $totalNews = News::count();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalReports' => $totalReports,
            'totalSos' => $totalSos,
            'totalNews' => $totalNews,
        ]);
    }

    /**
     * Manage users
     */
    public function users()
    {
        $users = User::where('role', 'user')->paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show user details
     */
    public function showUser(User $user)
    {
        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot delete admin user');
        }
        
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    /**
     * Manage reports
     */
    public function reports()
    {
        $reports = Report::with('user')->paginate(10);
        return view('admin.reports.index', ['reports' => $reports]);
    }

    /**
     * Show report details
     */
    public function showReport(Report $report)
    {
        return view('admin.reports.show', ['report' => $report]);
    }

    /**
     * Edit report
     */
    public function editReport(Report $report)
    {
        return view('admin.reports.edit', ['report' => $report]);
    }

    /**
     * Update report
     */
    public function updateReport(Request $request, Report $report)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,verified,resolved',
            'admin_notes' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $report->update($validated);
        return redirect()->route('admin.reports.show', $report)->with('success', 'Report updated successfully');
    }

    /**
     * Delete report
     */
    public function deleteReport(Report $report)
    {
        $report->delete();
        return redirect()->route('admin.reports')->with('success', 'Report deleted successfully');
    }

    /**
     * Manage SOS alerts
     */
    public function sos()
    {
        $sos = Sos::with('user')->paginate(10);
        return view('admin.sos.index', ['sos' => $sos]);
    }

    /**
     * Show SOS details
     */
    public function showSos(Sos $sos)
    {
        return view('admin.sos.show', ['sos' => $sos]);
    }

    /**
     * Edit SOS
     */
    public function editSos(Sos $sos)
    {
        return view('admin.sos.edit', ['sos' => $sos]);
    }

    /**
     * Update SOS
     */
    public function updateSos(Request $request, Sos $sos)
    {
        $validated = $request->validate([
            'status' => 'required|in:active,responded,resolved',
            'admin_response' => 'nullable|string',
        ]);

        $sos->update($validated);
        return redirect()->route('admin.sos.show', $sos)->with('success', 'SOS alert updated successfully');
    }

    /**
     * Delete SOS
     */
    public function deleteSos(Sos $sos)
    {
        $sos->delete();
        return redirect()->route('admin.sos')->with('success', 'SOS alert deleted successfully');
    }

    /**
     * Manage news
     */
    public function news()
    {
        $news = News::paginate(10);
        return view('admin.news.index', ['news' => $news]);
    }

    /**
     * Create news
     */
    public function createNews()
    {
        return view('admin.news.create');
    }

    /**
     * Store news
     */
    public function storeNews(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'disaster_type' => 'required|string|max:100',
            'status' => 'required|in:published,draft',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('news', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['image_path'] = $imagePath;
        News::create($validated);

        return redirect()->route('admin.news')->with('success', 'News created successfully');
    }

    /**
     * Edit news
     */
    public function editNews(News $news)
    {
        return view('admin.news.edit', ['news' => $news]);
    }

    /**
     * Update news
     */
    public function updateNews(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'disaster_type' => 'required|string|max:100',
            'status' => 'required|in:published,draft',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news')->with('success', 'News updated successfully');
    }

    /**
     * Delete news
     */
    public function deleteNews(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news')->with('success', 'News deleted successfully');
    }
}
