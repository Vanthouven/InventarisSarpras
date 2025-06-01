@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4">Buat Akun Baru</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('accounts.store') }}" method="POST" class="space-y-4 max-w-lg">
        @csrf

        {{-- Username (name) --}}
        <div>
            <label class="block font-medium">Username</label>
            <input 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                class="border p-2 w-full" 
                required
            >
        </div>
                
        @error('name')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        {{-- Password --}}
        <div>
            <label class="block font-medium">Password</label>
            <input 
                type="password" 
                name="password" 
                class="border p-2 w-full" 
                required
            >
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label class="block font-medium">Konfirmasi Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                class="border p-2 w-full" 
                required
            >
        </div>

        {{-- Pilih Role --}}
        <div>
            <label class="block font-medium">Pilih Role</label>
            <select name="role" class="border p-2 w-full" required>
                <option value="">-- Pilih Role --</option>
                @foreach($roles as $r)
                    <option value="{{ $r }}" {{ old('role') === $r ? 'selected' : '' }}>
                        {{ ucfirst($r) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Submit --}}
        <div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Buat Akun
            </button>
            <a href="{{ route('accounts.index') }}" class="ml-2 text-gray-600 hover:underline">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
