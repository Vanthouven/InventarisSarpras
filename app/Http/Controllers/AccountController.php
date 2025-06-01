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
        $roles = ['admin', 'petugas', 'viewer'];
        return view('accounts.create', compact('roles'));
    }

    /**
     * Simpan akun baru ke database.
     * Jika nama sudah terpakai, langsung kembalikan pesan "akun sudah ada".
     */
    public function store(Request $request)
    {
        // 1) Validasi dasar + pastikan `name` unik di tabel `users`
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'password' => ['required', 'confirmed'],
            'role' => 'required|in:admin,petugas,viewer',
        ], [
            'name.unique' => 'Akun dengan nama tersebut sudah ada.',
        ]);

        // 2) Simpan user baru (hash password terlebih dahulu)
        User::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        return redirect()->route('accounts.index')
                         ->with('success', 'Akun baru berhasil dibuat.');
    }

    /**
     * Hapus akun tertentu.
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus.');
    }
}
