<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
@extends('layouts.app')

@section('content')
<h2>Inventaris</h2>
<form action="{{ route('items.store') }}" method="POST">
    @csrf
    <input type="text" name="namaBarang" placeholder="Nama Item" required>
    <input type="number" name="jumlah" placeholder="Jumlah" required>
    <button type="submit">Tambah</button>
</form>
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
        @foreach ($items as $item)
            <tr>
                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                <td class="border px-2 py-1">{{ $item->namaBarang }}</td>
                <td class="border px-2 py-1">{{ $item->jumlah }}</td>
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
        @endforeach
    </tbody>
</table>
@endsection
</body>
</html>