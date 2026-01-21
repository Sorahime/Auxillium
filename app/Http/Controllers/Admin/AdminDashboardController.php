<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Show admin dashboard with statistics
     */
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalReports = 0; // Will populate when Report model exists
        $totalSos = 0;     // Will populate when SOS model exists
        $totalNews = 0;    // Will populate when News model exists

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
        return view('admin.reports.index');
    }

    /**
     * Manage SOS alerts
     */
    public function sos()
    {
        return view('admin.sos.index');
    }

    /**
     * Manage news
     */
    public function news()
    {
        return view('admin.news.index');
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
        ]);

        return redirect()->route('admin.news')->with('success', 'News created successfully');
    }

    /**
     * Edit news
     */
    public function editNews($id)
    {
        return view('admin.news.edit');
    }

    /**
     * Update news
     */
    public function updateNews(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'disaster_type' => 'required|string|max:100',
        ]);

        return redirect()->route('admin.news')->with('success', 'News updated successfully');
    }

    /**
     * Delete news
     */
    public function deleteNews($id)
    {
        return redirect()->route('admin.news')->with('success', 'News deleted successfully');
    }
}
