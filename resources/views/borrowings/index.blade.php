@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4">Daftar Peminjaman</h2>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="border px-2 py-1">#</th>
                <th class="border px-2 py-1">Nama</th>
                <th class="border px-2 py-1">Role</th>
                <th class="border px-2 py-1">Jurusan</th>
                <th class="border px-2 py-1">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $b)
            <tr>
                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                <td class="border px-2 py-1">{{ $b->nama }}</td>
                <td class="border px-2 py-1">{{ ucfirst($b->role) }}</td>
                <td class="border px-2 py-1">{{ $b->jurusan ?? '-' }}</td>
                <td class="border px-2 py-1">{{ $b->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $borrowings->links() }}
</div>
@endsection