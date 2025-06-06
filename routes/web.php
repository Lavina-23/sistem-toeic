<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\VerificationController;

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

Route::get('/language/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'id', 'zh'])) {
        session(['locale' => $lang]);
        app()->setLocale($lang);
    }
    return redirect()->back();
})->name('language.switch');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('peserta')->middleware(['role:peserta'])->group(function () {
        Route::get('/dashboard', [PesertaController::class, 'index'])->name('peserta.dashboard');
        Route::get('/history', [PesertaController::class, 'showHistory'])->name('peserta.history');
        Route::get('/create', [PesertaController::class, 'createPeserta'])->name('peserta.create');
        Route::get('/requestDokumen', [PesertaController::class, 'requestDokumen'])->name('peserta.requestDokumen');
        Route::post('/store', [PesertaController::class, 'storePeserta'])->name('peserta.store');
        Route::get('/score-datas', [ScoreController::class, 'getScoreData'])->name('peserta.score-datas');
        Route::get('/peserta/dashboard', [PengumumanController::class, 'showPengumuman'])->name('peserta.dashboard');
    });

    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/export-pdf', [AdminController::class, 'exportPDF'])->name('admin.export.pdf');
        Route::get('/score', [ScoreController::class, 'createScores'])->name('score.create');
        Route::post('/score', [ScoreController::class, 'importScores'])->name('score.import');
        Route::get('/create', [PengumumanController::class, 'createPengumuman'])->name('pengumuman.create');
        Route::post('/store', [PengumumanController::class, 'storePengumuman'])->name('pengumuman.store');
        Route::get('/verification', [VerificationController::class, 'index'])->name('verification');
        Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send.message');
        Route::get('/admin/pengumuman/create', [PengumumanController::class, 'createPengumuman'])->name('pengumuman.create');
        Route::post('/admin/pengumuman', [PengumumanController::class, 'storePengumuman'])->name('pengumuman.store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
