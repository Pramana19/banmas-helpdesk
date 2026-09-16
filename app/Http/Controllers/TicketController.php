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
        if (auth()->user()->role === 'admin') {
            $tickets = Ticket::with('category')->latest()->get();
        } else {
            $tickets = Ticket::with('category')
                        ->where('reporter_id', auth()->id())
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
        $ticket = Ticket::with('category')->findOrFail($id);

        if ($ticket->reporter_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Kamu tidak memiliki akses ke tiket ini.');
        }

        $technicians = [];
        if (auth()->user()->role === 'admin') {
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

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Status tiket berhasil diperbarui!');
    }
}