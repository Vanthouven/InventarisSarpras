<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                <th class="border px-2 py-1">Kelas</th>
                <th class="border px-2 py-1">Tanggal</th>
                <th class="border px-2 py-1">Barang Dipinjam</th>
                <th class="border px-2 py-1">Jumlah</th>
                <th class="border px-2 py-1">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $b)
            <tr>
                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                <td class="border px-2 py-1">{{ $b->nama }}</td>
                <td class="border px-2 py-1">{{ ucfirst($b->role) }}</td>
                <td class="border px-2 py-1">{{ $b->jurusan ?? '-' }}</td>
                <td class="border px-2 py-1">{{ $b->kelas ?? '-' }}</td>
                <td class="border px-2 py-1">{{ $b->created_at->format('d/m/Y') }}</td>
                <td class="border px-2 py-1">
                    @if($b->items->count())
                        <ul class="list-disc list-inside">
                            @foreach($b->items as $item)
                                <li>{{ $item->namaBarang }}</li>
                            @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </td>
                <td class="border px-2 py-1">
                    @if($b->items->count())
                        <ul class="list-decimal list-inside">
                            @foreach($b->items as $item)
                                <li>{{ $item->pivot->quantity }}</li>
                            @endforeach
                        </ul>
                    @else
                        -
                    @endif
                </td>
                <td class="border px-2 py-1">
                    @auth
                    @if(auth()->user()->role !== 'viewer')
                        @if($b->status === 'belum_kembali')
                            <form action="{{ route('borrowings.return', $b->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded"
                                    onclick="return confirm('Tandai peminjaman ini sebagai sudah kembali?');">
                                    Sudah Kembali
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500">Sudah kembali</span>
                        @endif
                    @else
                        @if($b->status === 'belum_kembali')
                            <span class="text-gray-500">Belum Kembali</span>
                        @else
                            <span class="text-gray-500">Sudah kembali</span>
                        @endif
                    @endif
                    @endauth
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{-- Pagination tanpa ikon panah --}}
    <div>
        {{ $borrowings->links('pagination::simple-tailwind') }}
    </div>
<div class="flex items-center justify-between mt-4">
    {{-- Summary --}}
    <div class="text-sm text-gray-700">
        Showing 
        {{ $borrowings->firstItem() }} 
        to 
        {{ $borrowings->lastItem() }} 
        of 
        {{ $borrowings->total() }} 
        results
    </div>
</div>

</div>
@endsection

</body>
</html>