<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Item;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function doLogin(Request $req)
    {
        $role = $req->input('role');

        if ($role === 'viewer') {
            // Ambil user pertama dengan role=viewer (sebagai guest)
            $user = User::where('role', 'viewer')->first();
            if (!$user) {
                return back()->withErrors(['role' => 'Tidak ada akun viewer.']);
            }
            Auth::login($user);
        } else {
            // validasi input
            $req->validate([
                'name'     => 'required|string',
                'password' => 'required|string',
                'role'     => 'required|in:petugas,admin',
            ]);

            // cari user sesuai name & role
            $user = User::where('name', $req->name)
                        ->where('role', $role)
                        ->first();

            if (!$user || Hash::check($req->password, $user->password)) {
                return back()->withErrors(['name' => 'Nama atau password salah.'])->withInput();
            }
            Auth::login($user);
        }

        // regenerasi session dan redirect ke dashboard
        $req->session()->regenerate();
        return redirect()->intended(route('home'));
    }

    // Dashboard (bisa Anda buat switch untuk tiap role)
    public function home()
    {
        $user = Auth::user();
        $items = Item::all();
        return view('home', compact('user', 'items'));
    }

    // Logout
    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('login');
    }
}
