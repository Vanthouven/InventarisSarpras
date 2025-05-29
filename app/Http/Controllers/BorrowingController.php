<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function create()
    {
        // daftar jurusan contoh
        $jurusan = ['Rekayasa Perangkat Lunak', 'Bisnis Digital', 'Layanan Perbankan', 'Akuntansi', 'Manajemen Perkantoran'];
        // daftar kelas (X, XI, XII)
        $kelas = ['X', 'XI', 'XII'];
        return view('borrowings.create', compact('jurusan', 'kelas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'    => 'required|string|max:255',
            'role'    => 'required|in:siswa,guru',
            'jurusan' => 'nullable|required_if:role,siswa|string',
        ]);

        Borrowing::create($data);

        return redirect()->route('borrowings.index')
                         ->with('success', 'Data peminjaman berhasil disimpan.');
    }

    public function index()
    {
        $borrowings = Borrowing::latest()->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }
}