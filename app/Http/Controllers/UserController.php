<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Wajib ditambahkan untuk hash password

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    // Fungsi baru: Menampilkan form tambah pengguna
    public function create()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        return view('users.create');
    }

    // Fungsi baru: Memproses penyimpanan pengguna baru ke database
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,teknisi,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password diamankan
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function updateRole(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $request->validate(['role' => 'required|in:admin,teknisi,user']);
        $user->update(['role' => $request->role]);
        
        return back()->with('success', 'Role pengguna berhasil diperbarui!');
    }
    
    // Fungsi untuk ubah nama (asli milikmu)
    public function updateName(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $request->validate(['name' => 'required|string|max:255']);
        $user->update(['name' => $request->name]);
        
        return back()->with('success', 'Nama pengguna berhasil diperbarui!');
    }

    // Fungsi baru: Menghapus pengguna dengan proteksi admin utama
    public function destroy(User $user)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus permanen.');
    }
    // Fungsi baru: Reset Password oleh Admin
    public function resetPassword(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $request->validate(['password' => 'required|string|min:8']);
        
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        
        return back()->with('success', 'Password untuk ' . $user->name . ' berhasil diubah!');
    }
}