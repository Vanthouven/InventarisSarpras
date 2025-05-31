<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Tampilkan daftar semua akun (hanya untuk admin).
     */
    public function index()
    {
        // Ambil users dengan kolom created_at yang sudah ter‐format di SQL
        $users = User::select([
                'id',
                'name',
                'role',
                DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') AS created_at_formatted")
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('accounts.index', compact('users'));
    }

    /**
     * Tampilkan form untuk membuat akun baru.
     */
    public function create()
    {
        // Daftar role yang boleh dipilih admin
        $roles = ['admin', 'petugas', 'viewer'];
        return view('accounts.create', compact('roles'));
    }

    /**
     * Simpan akun baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi masukan
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'password' => [
                'required',
                'confirmed',
            ],
            'role'     => 'required|in:admin,petugas,viewer',
        ]);

        // Simpan user
        User::create([
            'name'     => $data['name'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
        ]);

        return redirect()->route('accounts.index')
                         ->with('success', 'Akun baru berhasil dibuat.');
    }

    /**
     * Hapus akun tertentu.
     */
    public function destroy(User $user)
    {
        // Opsional: jika user itu adalah self (admin itu sendiri), abort
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus.');
    }
}
