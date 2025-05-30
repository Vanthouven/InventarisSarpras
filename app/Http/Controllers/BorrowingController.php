<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB; 

class BorrowingController extends Controller
{
    public function create()
    {
        // daftar jurusan contoh
        $jurusan = ['Rekayasa Perangkat Lunak', 'Bisnis Digital', 'Layanan Perbankan', 'Akuntansi', 'Manajemen Perkantoran'];
        // daftar kelas (X, XI, XII)
        $kelas = ['X', 'XI', 'XII'];
        $items   = Item::all();        // ambil daftar barang
        return view('borrowings.create', compact('jurusan','kelas','items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'    => 'required|string|max:255',
            'role'    => 'required|in:siswa,guru',
            'jurusan' => 'nullable|required_if:role,siswa|string',
            "kelas"   => 'nullable|required_if:role,siswa|string',
            'items'      => 'required|array|min:1',
            'items.*'    => 'exists:items,id',
            'quantity'   => 'required|array',
            'quantity.*' => 'integer|min:1',
        ]);

        // cek stok per-item
        foreach ($data['items'] as $i => $itemId) {
            $item = Item::find($itemId);
            $qty  = $data['quantity'][$i];
            if ($qty > $item->jumlah) {
                return back()
                    ->withErrors([
                        // beri tahu baris mana yang over
                        "quantity.$i" => "Stok {$item->namaBarang} hanya tersedia {$item->jumlah} unit.",
                    ])
                    ->withInput();
            }
        }

        // // simpan master
        // $borrowing = Borrowing::create($data);
        
        // // attach items + quantity
        // $attach = [];
        // foreach ($data['items'] as $i => $itemId) {
        //     $attach[$itemId] = ['quantity' => $data['quantity'][$i]];
        // }
        // $borrowing->items()->attach($attach);
    
        // return redirect()->route('borrowings.index')
        //                  ->with('success', 'Data peminjaman berhasil disimpan.');

        // Borrowing::create($data);

        // return redirect()->route('borrowings.index')
        //                  ->with('success', 'Data peminjaman berhasil disimpan.');

         DB::transaction(function() use ($data) {
        // Simpan header peminjaman
        $borrowing = Borrowing::create([
            'nama'    => $data['nama'],
            'role'    => $data['role'],
            'jurusan' => $data['jurusan'] ?? null,
            'kelas'   => $data['kelas']   ?? null,
        ]);

        // Attach items + quantity, dan update stok
        foreach ($data['items'] as $i => $itemId) {
            $qty  = $data['quantity'][$i];

            // 1. Attach ke pivot
            $borrowing->items()->attach($itemId, ['quantity' => $qty]);

            // 2. Kurangi stok di tabel items
            Item::where('id', $itemId)
                ->decrement('jumlah', $qty);
        }
    });
        return redirect()->route('borrowings.index')
                     ->with('success', 'Data peminjaman berhasil disimpan dan stok diperbarui.');
    }

    public function index()
    {
        $borrowings = Borrowing::latest()->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }

        public function markReturned($id)
    {
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status === 'sudah_kembali') {
            return back()->with('info', 'Barang sudah ditandai kembali sebelumnya.');
        }

        DB::transaction(function() use ($borrowing) {
            // 1) Update status
            $borrowing->update(['status' => 'sudah_kembali']);

            // 2) Kembalikan stok ke items
            foreach ($borrowing->items as $item) {
                Item::where('id', $item->id)
                    ->increment('jumlah', $item->pivot->quantity);
            }
        });

        return back()->with('success', 'Status dikembalikan dan stok sudah dipulihkan.');
    }
}