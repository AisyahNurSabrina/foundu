<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PickupPointController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing page redirects to items
Route::get('/', function () {
    return redirect()->route('items.index');
});

// Dashboard - role-based redirect
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (all roles)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Items CRUD
    Route::resource('items', ItemController::class);

    // Claim item
    Route::post('/items/{item}/claim', [ClaimController::class, 'store'])->name('items.claim');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('admin.dashboard');

    // Categories CRUD
    Route::resource('categories', CategoryController::class)->names('categories');

    // Pickup Points CRUD
    Route::resource('pickup-points', PickupPointController::class)->names('pickup-points');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::post('/items/{item}/report', [ReportController::class, 'store'])->name('admin.items.report');
});

require __DIR__.'/auth.php';
