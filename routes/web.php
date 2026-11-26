
<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminKosController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

// Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman publik
Route::get('/cari-kos', [KosController::class, 'index'])
    ->name('kos.index');

Route::get('/detail-kos/{id}', [KosController::class, 'show'])
    ->name('kos.detail');

// Halaman yang wajib login
Route::middleware('auth')->group(function () {

    // Pengalihan dashboard berdasarkan role
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'pemilik') {
            return view('dashboard');
        }

        return redirect()->route('kos.index');
    })->name('dashboard');

    // Fitur khusus admin
    Route::middleware('role:admin')->group(function () {

        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Kelola Data Kos
        Route::get('/admin/kos', [AdminKosController::class, 'index'])
            ->name('admin.kos.index');

        // Kelola Pengguna
        Route::get('/admin/pengguna', [AdminUserController::class, 'index'])
            ->name('admin.users.index');
    });

    // Fitur khusus pemilik kos
    Route::middleware('role:pemilik')->group(function () {

        Route::get('/pemilik/kos', [KosController::class, 'myKos'])
            ->name('pemilik.kos.index');

        Route::get('/pemilik/kos/tambah', [KosController::class, 'create'])
            ->name('pemilik.kos.create');

        Route::post('/pemilik/kos', [KosController::class, 'store'])
            ->name('pemilik.kos.store');

        Route::get('/pemilik/kos/{id}/edit', [KosController::class, 'edit'])
            ->name('pemilik.kos.edit');

        Route::put('/pemilik/kos/{id}', [KosController::class, 'update'])
            ->name('pemilik.kos.update');

        Route::delete('/pemilik/kos/{id}/foto/{photoId}', [KosController::class, 'destroyPhoto'])
            ->name('pemilik.kos.photo.destroy');

        Route::delete('/pemilik/kos/{id}', [KosController::class, 'destroy'])
            ->name('pemilik.kos.destroy');
    });

    // Pengaturan profil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Route autentikasi Breeze
require __DIR__.'/auth.php';
