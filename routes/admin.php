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
    Route::get('/reports/{report}', [AdminDashboardController::class, 'showReport'])->name('reports.show');
    Route::get('/reports/{report}/edit', [AdminDashboardController::class, 'editReport'])->name('reports.edit');
    Route::put('/reports/{report}', [AdminDashboardController::class, 'updateReport'])->name('reports.update');
    Route::delete('/reports/{report}', [AdminDashboardController::class, 'deleteReport'])->name('reports.destroy');

    // SOS Management
    Route::get('/sos', [AdminDashboardController::class, 'sos'])->name('sos');
    Route::get('/sos/{sos}', [AdminDashboardController::class, 'showSos'])->name('sos.show');
    Route::get('/sos/{sos}/edit', [AdminDashboardController::class, 'editSos'])->name('sos.edit');
    Route::put('/sos/{sos}', [AdminDashboardController::class, 'updateSos'])->name('sos.update');
    Route::delete('/sos/{sos}', [AdminDashboardController::class, 'deleteSos'])->name('sos.destroy');

    // News Management
    Route::get('/news', [AdminDashboardController::class, 'news'])->name('news');
    Route::get('/news/create', [AdminDashboardController::class, 'createNews'])->name('news.create');
    Route::post('/news', [AdminDashboardController::class, 'storeNews'])->name('news.store');
    Route::get('/news/{news}/edit', [AdminDashboardController::class, 'editNews'])->name('news.edit');
    Route::put('/news/{news}', [AdminDashboardController::class, 'updateNews'])->name('news.update');
    Route::delete('/news/{news}', [AdminDashboardController::class, 'deleteNews'])->name('news.destroy');
});
