<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EvenementAdminController;
use App\Http\Controllers\Admin\LieuAdminController;
use App\Http\Controllers\Admin\SeanceAdminController;
use App\Http\Controllers\SuperAdmin\ArticleController;
use App\Http\Controllers\SuperAdmin\FestivalSuperAdminController;
use App\Http\Controllers\SuperAdmin\FilmSuperAdminController;
use App\Http\Controllers\SuperAdmin\LieuSuperAdminController;
use App\Http\Controllers\SuperAdmin\StatsController;
use App\Http\Controllers\SuperAdmin\UserSuperAdminController;
use App\Http\Controllers\Public\AgendaController;
use App\Http\Controllers\Public\DecouvrirController;
use App\Http\Controllers\Public\FestivalController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\LieuController;
use App\Http\Controllers\Public\RappelController;
use App\Http\Controllers\Public\SeanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/ce-soir', [SeanceController::class, 'index'])->name('ce-soir');
Route::get('/films/{film}', [SeanceController::class, 'show'])->name('film.show');
Route::post('/rappels', [RappelController::class, 'store'])->name('rappels.store');
Route::get('/lieux', [LieuController::class, 'index'])->name('lieux.index');
Route::get('/lieux/{lieu}', [LieuController::class, 'show'])->name('lieux.show');
Route::get('/decouvrir', [DecouvrirController::class, 'index'])->name('decouvrir');
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda');
Route::get('/festival', [FestivalController::class, 'actif'])->name('festival.actif');
Route::get('/festival/{festival}', [FestivalController::class, 'show'])->name('festival.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Espace gérant
Route::middleware(['auth', 'role:gerant'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/seances/grille', [SeanceAdminController::class, 'grille'])->name('seances.grille');
    Route::post('/seances/grille', [SeanceAdminController::class, 'grilleStore'])->name('seances.grille.store');
    Route::resource('seances', SeanceAdminController::class)->except(['show']);

    Route::resource('evenements', EvenementAdminController::class)->except(['show']);

    Route::get('/lieu/edit', [LieuAdminController::class, 'edit'])->name('lieu.edit');
    Route::put('/lieu', [LieuAdminController::class, 'update'])->name('lieu.update');
});

// Espace super admin
Route::middleware(['auth', 'role:admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [StatsController::class, 'index'])->name('dashboard');

    Route::patch('/lieux/{lieu}/toggle', [LieuSuperAdminController::class, 'toggle'])->name('lieux.toggle');
    Route::resource('lieux', LieuSuperAdminController::class)->except(['show']);

    Route::resource('films', FilmSuperAdminController::class)->except(['show']);

    Route::patch('/users/{user}/toggle', [UserSuperAdminController::class, 'toggle'])->name('users.toggle');
    Route::resource('users', UserSuperAdminController::class)->except(['show']);

    Route::patch('/festivals/{festival}/activer', [FestivalSuperAdminController::class, 'activer'])->name('festivals.activer');
    Route::patch('/festivals/{festival}/clore', [FestivalSuperAdminController::class, 'clore'])->name('festivals.clore');
    Route::get('/festivals/{festival}/programme', [FestivalSuperAdminController::class, 'programme'])->name('festivals.programme');
    Route::post('/festivals/{festival}/programme', [FestivalSuperAdminController::class, 'programmeStore'])->name('festivals.programme.store');
    Route::resource('festivals', FestivalSuperAdminController::class)->except(['show']);

    Route::resource('editorial', ArticleController::class)->except(['show']);
});

require __DIR__.'/auth.php';
