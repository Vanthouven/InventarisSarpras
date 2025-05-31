<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function __construct()
    {
        // Memastikan hanya user yang sudah login yang bisa mengakses semua method ini
        $this->middleware('auth');
    }

    /**
     * Tampilkan daftar semua item.
     */
    public function index()
    {
        // Mengurutkan berdasarkan waktu dibuat terbaru
        $items = Item::orderBy('created_at', 'desc')->get();

        // Jika Anda butuh total item, Anda bisa menambahkannya:
        // $total_items = $items->count();

        return view('items.index', compact('items'));
    }

    /**
     * Tampilkan form untuk membuat item baru.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Simpan item baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input: namaBarang wajib unik, jumlah minimal 0
        $data = $request->validate([
            'namaBarang' => 'required|string|max:255|unique:items,namaBarang',
            'jumlah'     => 'required|integer|min:0',
        ]);

        Item::create($data);

        return redirect()
            ->route('items.index')
            ->with('success', 'Item baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit untuk item yang dipilih.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Proses update terhadap item.
     */
    public function update(Request $request, Item $item)
    {
        // Validasi input: namaBarang unik kecuali milik item ini, jumlah minimal 0
        $data = $request->validate([
            'namaBarang' => 'required|string|max:255|unique:items,namaBarang,' . $item->id,
            'jumlah'     => 'required|integer|min:0',
        ]);

        $item->update($data);

        return redirect()
            ->route('items.index')
            ->with('success', "Item \"{$item->namaBarang}\" berhasil diubah.");
    }

    /**
     * Hapus item yang dipilih.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return back()->with('success', 'Item berhasil dihapus.');
    }
}
