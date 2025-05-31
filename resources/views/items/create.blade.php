@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h2 class="text-2xl mb-4">Tambah Item Baru</h2>

    {{-- Tampilkan pesan kesalahan validasi --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Nama Barang --}}
        <div>
            <label class="block font-medium">Nama Barang</label>
            <input 
                type="text" 
                name="namaBarang" 
                value="{{ old('namaBarang') }}" 
                class="border p-2 w-full rounded" 
                required
            >
            @error('namaBarang')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Jumlah --}}
        <div>
            <label class="block font-medium">Jumlah</label>
            <input 
                type="number" 
                name="jumlah" 
                value="{{ old('jumlah', 0) }}" 
                min="0" 
                class="border p-2 w-full rounded" 
                required
            >
            @error('jumlah')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <div>
            <button 
                type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
            >
                Tambah Item
            </button>
            <a href="{{ route('items.index') }}" 
               class="ml-2 text-gray-600 hover:underline">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
