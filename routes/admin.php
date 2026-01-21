<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::get('/users/{user}', [AdminDashboardController::class, 'showUser'])->name('users.show');
    Route::delete('/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('users.destroy');

    // Report Management
    Route::get('/reports', [AdminDashboardController::class, 'reports'])->name('reports');

    // SOS Management
    Route::get('/sos', [AdminDashboardController::class, 'sos'])->name('sos');

    // News Management
    Route::get('/news', [AdminDashboardController::class, 'news'])->name('news');
    Route::get('/news/create', [AdminDashboardController::class, 'createNews'])->name('news.create');
    Route::post('/news', [AdminDashboardController::class, 'storeNews'])->name('news.store');
    Route::get('/news/{id}/edit', [AdminDashboardController::class, 'editNews'])->name('news.edit');
    Route::put('/news/{id}', [AdminDashboardController::class, 'updateNews'])->name('news.update');
    Route::delete('/news/{id}', [AdminDashboardController::class, 'deleteNews'])->name('news.destroy');
});
