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
use App\Http\Controllers\VerificationReqController;
use App\Http\Controllers\ITCController;
use App\Models\VerificationReq;

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
        'itc' => redirect()->route('itc.dashboard'),
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/language/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'id', 'zh', 'kr', 'jp'])) {
        session(['locale' => $lang]);
        app()->setLocale($lang);
    }
    return redirect()->back();
})->name('language.switch');

Route::prefix('pengumuman')->name('pengumuman.')->group(function () {

    Route::get('/', [PengumumanController::class, 'index'])->name('index');
    Route::get('/create', [PengumumanController::class, 'create'])->name('create');
    Route::post('/', [PengumumanController::class, 'store'])->name('store');
    Route::get('/{id}', [PengumumanController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PengumumanController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PengumumanController::class, 'update'])->name('update');
    Route::delete('/{id}', [PengumumanController::class, 'destroy'])->name('destroy');
    Route::patch('/{id}/toggle-status', [PengumumanController::class, 'toggleStatus'])->name('toggle-status');
    Route::get('/{id}/download', [PengumumanController::class, 'downloadFile'])->name('download');
    Route::put('/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('peserta')->middleware(['role:peserta'])->group(function () {
        Route::get('/dashboard', [PesertaController::class, 'index'])->name('peserta.dashboard');
        Route::get('/history', [PesertaController::class, 'showHistory'])->name('peserta.history');
        Route::get('/create', [PesertaController::class, 'createPeserta'])->name('peserta.create');
        Route::post('/store', [PesertaController::class, 'storePeserta'])->name('peserta.store');
        Route::get('/request-document', [VerificationReqController::class, 'requestDocument'])->name('request-document');
        Route::post('/store/request-document', [VerificationReqController::class, 'storeRequest'])->name('store.request-document');
        Route::get('/score-datas', [ScoreController::class, 'getScoreData'])->name('peserta.score-datas');
        // Route::get('/peserta/dashboard', [PengumumanController::class, 'showPengumuman'])->name('peserta.dashboard');
    });

    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/export-pdf', [AdminController::class, 'exportPDF'])->name('admin.export.pdf');
        Route::get('/score', [ScoreController::class, 'createScores'])->name('score.create');
        Route::post('/score', [ScoreController::class, 'importScores'])->name('score.import');
        Route::get('/create', [PengumumanController::class, 'createPengumuman'])->name('pengumuman.create');
        Route::post('/store', [PengumumanController::class, 'storePengumuman'])->name('pengumuman.store');
        Route::get('/verification', [VerificationController::class, 'index'])->name('verification');
        Route::get('/verificationReq', [VerificationReqController::class, 'index'])->name('verificationReq');
        Route::get('/pengumuman/create', [PengumumanController::class, 'createPengumuman'])->name('pengumuman.create');
        Route::post('/pengumuman', [PengumumanController::class, 'storePengumuman'])->name('pengumuman.store');
        Route::get('/pengguna', [AdminController::class, 'daftarPengguna'])->name('admin.pengguna');
        Route::get('/export-pengguna', [AdminController::class, 'exportPengguna'])->name('admin.export.pengguna');
        Route::post('/update-verification/{id}', [VerificationReqController::class, 'updateVerification'])->name('update-verification');
        Route::post('/pengguna/tambah', [AdminController::class, 'storePengguna'])->name('admin.pengguna.tambah');
        Route::get('/export-nomor', [PesertaController::class, 'exportNoTelp'])->name('admin.export.nomor');
        Route::get('/export-peserta', [PesertaController::class, 'exportPeserta'])->name('admin.export.peserta');
    });

    Route::prefix('itc')->middleware(['role:itc'])->group(function () {
        Route::get('/dashboard', [VerificationController::class, 'index'])->name('itc.dashboard');
        Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send.message');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
