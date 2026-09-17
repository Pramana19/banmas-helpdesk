<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya Admin yang boleh mengakses halaman ini.');
        }
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        return view('categories.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);
        // Tambahkan otomatis slug agar tidak error not-null constraint
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    // Tambahkan logika update kategori
    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Nama kategori berhasil diperbarui!');
    }

    // Perbaiki fungsi destroy agar mengenali id
    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $category = Category::findOrFail($id);
        $category->delete();
        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}