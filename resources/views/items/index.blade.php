@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4">Inventaris</h2>

    {{-- 1) Form Tambah Barang --}}
    <div class="mb-6">
        <p class="font-medium mb-2">Tambah barang</p>
        <form action="{{ route('items.store') }}" method="POST" class="flex space-x-2">
            @csrf
            <input
                type="text"
                name="namaBarang"
                placeholder="Nama Item"
                required
                class="border p-2 rounded flex-1"
            >
            <input
                type="number"
                name="jumlah"
                placeholder="Jumlah"
                required
                class="border p-2 rounded w-24"
                min="0"
            >
            <button
                type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
            >
                Tambah
            </button>
        </form>
    </div>

    {{-- 2) Warning Low Stock --}}
    @if(isset($lowStock) && $lowStock->count() > 0)
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded">
            <p class="font-semibold">⚠ Peringatan: Stok Hampir Habis</p>
            <ul class="list-disc list-inside mt-2">
                @foreach($lowStock as $low)
                    <li>
                        <span class="font-medium">{{ $low->namaBarang }}</span> — 
                        sisa <span class="font-semibold">{{ $low->jumlah }}</span> unit
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 3) Tabel Daftar Barang --}}
    <table class="w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="border px-2 py-1 text-left">#</th>
                <th class="border px-2 py-1 text-left">Nama Barang</th>
                <th class="border px-2 py-1 text-left">Jumlah</th>
                <th class="border px-2 py-1 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                    <td class="border px-2 py-1">{{ $item->namaBarang }}</td>
                    <td class="border px-2 py-1">
                        @if($item->jumlah < 5)
                            <span class="text-red-600 font-semibold">{{ $item->jumlah }}</span>
                        @else
                            {{ $item->jumlah }}
                        @endif
                    </td>
                    <td class="border px-2 py-1 space-x-2">
                        {{-- Tombol Edit --}}
                        <a href="{{ route('items.edit', $item->id) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus {{ $item->namaBarang }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-600">Belum ada item.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
