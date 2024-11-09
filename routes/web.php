<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/apps')->middleware(['auth', 'verified'])->group(function () {
    Route::get('', [AppController::class, 'index'])
        ->name('apps.index');
    Route::get('{client}/edit', [AppController::class, 'edit'])
        ->name('apps.edit');
    Route::put('{client}', [AppController::class, 'update'])
        ->name('apps.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('oauth')->group(base_path('routes/oauth.php'));

require __DIR__.'/auth.php';
