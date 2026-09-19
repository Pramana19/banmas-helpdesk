<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rute Profil Bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Rute Tiket Bantuan
    Route::resource('tickets', TicketController::class);
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');

    // Rute Kategori Tiket
    Route::resource('categories', CategoryController::class);

    // Rute Kelola User & Teknisi
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::patch('/users/{user}/name', [UserController::class, 'updateName'])->name('users.updateName');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Tambahan untuk fitur Reset Password yang akan kita buat
    Route::patch('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
});

require __DIR__.'/auth.php';