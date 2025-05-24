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
    Route::prefix('peserta')->middleware(['role:peserta'])->group(function () {
        Route::get('/dashboard', [PesertaController::class, 'index'])->name('peserta.dashboard');
        Route::get('/history', [PesertaController::class, 'showHistory'])->name('peserta.history');
        Route::get('/create', [PesertaController::class, 'createPeserta'])->name('peserta.create');
        Route::post('/store', [PesertaController::class, 'storePeserta'])->name('peserta.store');
        Route::get('/peserta/dashboard', [PesertaController::class, 'showPengumuman'])->name('peserta.dashboard');
    });
    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/score', [AdminController::class, 'createScores'])->name('score.create');
        Route::post('/score', [AdminController::class, 'importScores'])->name('score.import');
        Route::get('/create', [AdminController::class, 'createPengumuman'])->name('pengumuman.create');
        Route::post('/store', [AdminController::class, 'storePengumuman'])->name('pengumuman.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/language/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'id'])) {
        session(['locale' => $lang]);
        app()->setLocale($lang);
    }
    return redirect()->back();
})->name('language.switch');

require __DIR__ . '/auth.php';

