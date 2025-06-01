<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest']);

Route::get('/dashboard', function () {
    $user = Auth::user();

    return match ($user->level) {
        'admin' => redirect()->route('admin.dashboard'),
        'peserta' => redirect()->route('peserta.dashboard'),
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Peserta Routes
    Route::prefix('peserta')->middleware(['role:peserta'])->group(function () {
        Route::get('/dashboard', [PesertaController::class, 'index'])->name('peserta.dashboard');
        Route::get('/history', [PesertaController::class, 'showHistory'])->name('peserta.history');
        Route::get('/create', [PesertaController::class, 'createPeserta'])->name('peserta.create');
        Route::post('/store', [PesertaController::class, 'storePeserta'])->name('peserta.store');
        // Duplicate route removed - using the one above for dashboard
        // Route::get('/peserta/dashboard', [PesertaController::class, 'showPengumuman'])->name('peserta.dashboard');
    });

    // Admin Routes
    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Score Management
        Route::get('/score', [AdminController::class, 'createScores'])->name('score.create');
        Route::post('/score', [AdminController::class, 'importScores'])->name('score.import');
        
        // Pengumuman Management - Complete CRUD
        Route::get('/create', [AdminController::class, 'createPengumuman'])->name('pengumuman.create');
        Route::post('/store', [AdminController::class, 'storePengumuman'])->name('pengumuman.store');
        Route::patch('/pengumuman/{id}/activate', [AdminController::class, 'activatePengumuman'])->name('pengumuman.activate');
        Route::patch('/pengumuman/{id}/deactivate', [AdminController::class, 'deactivatePengumuman'])->name('pengumuman.deactivate');
        Route::put('/pengumuman/{id}', [AdminController::class, 'updatePengumuman'])->name('pengumuman.update');
        Route::delete('/pengumuman/{id}', [AdminController::class, 'destroyPengumuman'])->name('pengumuman.destroy');
        
        // Message Management
        Route::get('/send-message', function () {
            return view('admin.create-message');
        })->name('admin.message.create');
        Route::post('/send-message', [AdminController::class, 'sendMessage'])->name('send.message');
    });
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Language Switch Route
Route::get('/language/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'id', 'zh'])) {
        session(['locale' => $lang]);
        app()->setLocale($lang);
    }
    return redirect()->back();
})->name('language.switch');

require __DIR__ . '/auth.php';