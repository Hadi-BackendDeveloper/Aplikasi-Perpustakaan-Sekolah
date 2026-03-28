<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\AdminPeminjamanController;
use App\Http\Controllers\Admin\KritikController as AdminKritikController;

use App\Http\Controllers\Siswa\HomeController;
use App\Http\Controllers\Siswa\KritikController;
use App\Http\Controllers\Siswa\PustakaController;
use App\Http\Controllers\Siswa\SiswaAuthController;
use App\Http\Controllers\Siswa\PeminjamanController;
use App\Http\Controllers\Siswa\RiwayatController;
use App\Http\Controllers\Siswa\ProfilController;

/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin']);
Route::post('/admin/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('admin')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::get('/logout', [AuthController::class, 'logout']);

    // MEMBER
    Route::resource('member', MemberController::class);
    Route::post('/member/delete-multiple', [MemberController::class, 'deleteMultiple']);

    // BUKU
    Route::resource('buku', BukuController::class);
    Route::post('/buku/delete-multiple', [BukuController::class, 'deleteMultiple']);

    // PEMINJAMAN (FIX)
    Route::get('/peminjaman', [AdminPeminjamanController::class, 'index']);
    
    Route::post('/peminjaman/{id}/kembalikan', [AdminPeminjamanController::class, 'kembalikan'])
        ->name('admin.peminjaman.kembalikan');
    Route::post('/peminjaman/bulk-delete', [AdminPeminjamanController::class, 'bulkDelete'])
        ->name('admin.peminjaman.bulkDelete');

    // KRITIK dan SARAN    
    Route::get('/kritik', [AdminKritikController::class, 'index'])
        ->name('admin.kritik.index');
});

/*
|--------------------------------------------------------------------------
| SISWA (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index']);

Route::post('/login-siswa', [SiswaAuthController::class, 'login'])->name('login.siswa');

Route::post('/logout', function () {
    session()->flush();
    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| SISWA AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('auth.siswa')->group(function () {

    Route::get('/pustaka', [PustakaController::class, 'index'])
        ->name('siswa.pustaka');

    Route::post('/pinjam-buku', [PeminjamanController::class, 'store'])
        ->name('siswa.pinjam');

    Route::get('/riwayat', [RiwayatController::class, 'index'])
        ->name('siswa.riwayat');

    Route::get('/profil', [ProfilController::class, 'index'])
        ->name('siswa.profil');

    Route::post('/profil/update', [ProfilController::class, 'update'])
        ->name('siswa.profil.update');
});

/*
|--------------------------------------------------------------------------
| KRITIK
|--------------------------------------------------------------------------
*/
Route::post('/kritik', [KritikController::class, 'store'])
    ->name('kritik.store');