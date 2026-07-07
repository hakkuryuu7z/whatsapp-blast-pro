<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BlastController;
use App\Http\Controllers\DashboardController;

// Halaman depan langsung diarahkan ke login
Route::get('/', function () {
    return redirect('/login');
});

// ROUTE YANG BISA DIAKSES SEMUA USER (Admin & User biasa)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

   Route::get('/blast', [BlastController::class, 'index'])->name('blast');
    Route::post('/blast/log', [BlastController::class, 'storeLog'])->name('blast.log');

    Route::get('/devices', function () {
        return view('devices.index');
    })->name('devices');

    // --- INI YANG TADI HILANG (RUTE PROFILE BREEZE) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ROUTE KHUSUS ADMIN (Hanya Admin yang bisa akses)
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

require __DIR__.'/auth.php';