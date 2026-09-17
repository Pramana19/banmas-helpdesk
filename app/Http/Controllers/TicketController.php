<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\User;

class TicketController extends Controller
{
    // 1. Menampilkan daftar tiket (Bisa bedakan Admin vs User)
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            // Admin bisa melihat semua daftar tiket
            $tickets = Ticket::with('category')->latest()->get();
        } elseif ($user->role === 'teknisi') {
            // Teknisi bisa melihat tiket yang dia laporkan SENDIRI atau yang DITUGASKAN kepadanya
            $tickets = Ticket::with('category')
                        ->where('reporter_id', $user->id)
                        ->orWhere('technician_id', $user->id)
                        ->latest()->get();
        } else {
            // Karyawan biasa / user hanya melihat tiket yang dia laporkan
            $tickets = Ticket::with('category')
                        ->where('reporter_id', $user->id)
                        ->latest()->get();
        }

        return view('tickets.index', compact('tickets'));
    }

    // 2. Menampilkan form buat tiket baru
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    // 3. Menyimpan tiket baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'priority' => 'required|string',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        $validated['ticket_number'] = 'TKT-' . date('Ymd') . '-' . rand(100, 999);
        $validated['reporter_id'] = auth()->id();
        $validated['status'] = 'Open';

        Ticket::create($validated);

        return redirect()->route('tickets.index')->with('success', 'Tiket bantuan berhasil dibuat!');
    }

    // 4. Menampilkan halaman detail tiket
    public function show($id)
    {
        $ticket = Ticket::with(['category', 'reporter', 'technician'])->findOrFail($id);
        $user = auth()->user();

        // Teknisi boleh buka jika dia pelapor ATAU teknisi yang ditugaskan
        $isAuthorized = ($ticket->reporter_id === $user->id) || 
                        ($ticket->technician_id === $user->id) || 
                        ($user->role === 'admin');

        if (!$isAuthorized) {
            abort(403, 'Kamu tidak memiliki akses ke tiket ini.');
        }

        $technicians = [];
        if ($user->role === 'admin') {
            $technicians = User::where('role', 'teknisi')->get();
        }

        return view('tickets.show', compact('ticket', 'technicians'));
    }

    // 5. Memperbarui status atau teknisi (Khusus Admin/Teknisi)
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        if (auth()->user()->role === 'user') {
            abort(403, 'Kamu tidak memiliki izin untuk mengubah tiket.');
        }

        $validated = $request->validate([
            'status' => 'required|string',
            'technician_id' => 'nullable|exists:users,id',
        ]);

        $ticket->update($validated);

        return redirect()->route('tickets.index')->with('success', 'Status tiket berhasil diperbarui!');
    }

    // 6. Menghapus tiket permanen (Khusus Admin)
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya Admin yang berhak menghapus data tiket.');
        }

        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dihapus secara permanen.');
    }
}