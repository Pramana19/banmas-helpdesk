<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard dengan Injeksi Data Statistik
Route::get('/dashboard', function () {
    $user = auth()->user();
    $query = Ticket::query();

    // Filter data berdasarkan Role
    if ($user->role === 'teknisi') {
        $query->where(function($q) use ($user) {
            $q->where('technician_id', $user->id)->orWhere('reporter_id', $user->id);
        });
    } elseif ($user->role === 'user') {
        $query->where('reporter_id', $user->id);
    }

    // Hitung Statistik Widget
    $totalTickets = (clone $query)->count();
    $openTickets = (clone $query)->where('status', 'Open')->count();
    $resolvedTickets = (clone $query)->whereIn('status', ['Resolved', 'Closed'])->count();
    $processTickets = $totalTickets - ($openTickets + $resolvedTickets); // Sisanya dianggap In Progress / Assigned

    // Ambil 5 Tiket Terbaru untuk Tabel
    $recentTickets = (clone $query)->with(['category', 'reporter'])->latest()->take(5)->get();

    // Siapkan Data untuk Grafik Pie (Chart.js)
    $categoryData = (clone $query)->select('category_id', DB::raw('count(*) as total'))
                                  ->groupBy('category_id')
                                  ->with('category')
                                  ->get();
    
    $chartLabels = $categoryData->pluck('category.name');
    $chartValues = $categoryData->pluck('total');

    return view('dashboard', compact(
        'totalTickets', 'openTickets', 'resolvedTickets', 'processTickets', 
        'recentTickets', 'chartLabels', 'chartValues'
    ));
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
    Route::patch('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
});

require __DIR__.'/auth.php';