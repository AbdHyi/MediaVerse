<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\GenreController as AdminGenreController;
use App\Http\Controllers\Admin\StudioController as AdminStudioController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ProfileCommentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::get('/u/{user}', [UserProfileController::class, 'show'])->name('profile.show');

// Publik — Guest boleh lihat
Route::get('/media/{media:slug}', [MediaController::class, 'show'])->name('media.show');

// Semua route berauth (dashboard, profile, DAN admin) dibungkus 'auth' + 'active'
Route::middleware(['auth', 'active'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/media/{media}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::delete('/media/{media}/review', [ReviewController::class, 'destroy'])->name('review.destroy');
    Route::post('/media/{media}/watchlist', [WatchlistController::class, 'toggle'])->name('watchlist.toggle');
    Route::post('/media/{media}/favorite', [FavoriteController::class, 'toggle'])->name('favorite.toggle');

    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('/u/{user}/comments', [ProfileCommentController::class, 'store'])->name('profile.comments.store');

    // ADMIN + ABSOLUTE ADMIN
    Route::middleware('role:admin,absolute_admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

            Route::resource('media', AdminMediaController::class)->parameters(['media' => 'media'])->except(['show']);
            Route::resource('genres', AdminGenreController::class)->only(['index', 'store', 'update', 'destroy']);
            Route::resource('studios', AdminStudioController::class)->parameters(['studios' => 'studio']);
        });

    // ABSOLUTE ADMIN ONLY (nested juga)
    Route::middleware('role:absolute_admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
            Route::put('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.updateRole');
            Route::put('/users/{user}/status', [AdminUserController::class, 'toggleActive'])->name('users.toggleStatus');
        });

});

require __DIR__.'/auth.php';