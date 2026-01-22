<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SosController;
use App\Http\Controllers\OfflineMapController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// front
Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/news', [FrontController::class, 'news'])->name('news');
Route::get('/service', [FrontController::class, 'service'])->name('service');

Route::middleware(['auth'])->group(function () {
    
    // forum
    Route::get('/forum/{province}', [ForumController::class, 'show'])->name('forum.show');

    // map
    Route::get('/map/{province}', [MapController::class, 'show'])->name('map.show');

    // report bencana
    Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
    Route::get('/my-reports', [ReportController::class, 'myReports'])->name('report.my');
    Route::get('/report/{report}', [ReportController::class, 'show'])->name('report.show');

    // offline map
    Route::get('/offline-maps', [OfflineMapController::class, 'index'])->name('offline.index');

    // SOS
    Route::get('/sos/create', [SosController::class, 'create'])->name('sos.create');
    Route::post('/sos', [SosController::class, 'store'])->name('sos.store');
    Route::get('/my-alerts', [SosController::class, 'myAlerts'])->name('sos.my');
    Route::get('/sos/{sos}', [SosController::class, 'show'])->name('sos.show');

    // news
    Route::get('/news', [FrontController::class, 'news'])->name('news');

    // profile
    Route::get('/profile', [FrontController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // dashboard redirect to home
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');

});

require __DIR__.'/auth.php';

// Simple JSON API to support the PWA and admin UI (no blade changes)
Route::prefix('api')->middleware(['auth'])->group(function () {
    Route::get('/news', [\App\Http\Controllers\ApiController::class, 'news']);
    Route::get('/sos', [\App\Http\Controllers\ApiController::class, 'sos']);
    Route::get('/reports', [\App\Http\Controllers\ApiController::class, 'reports']);
    Route::get('/offline-maps', [\App\Http\Controllers\ApiController::class, 'offlineMaps']);
    Route::get('/offline-maps/{id}/download', [\App\Http\Controllers\ApiController::class, 'downloadOfflineMap']);
});

