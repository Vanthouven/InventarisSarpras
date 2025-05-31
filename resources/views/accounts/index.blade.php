@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4">Manajemen Akun</h2>

    {{-- Tampilkan alert sukses / error --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-4">
        {{-- Tombol menuju form create --}}
        <a href="{{ route('accounts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            + Buat Akun Baru
        </a>
    </div>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="border px-2 py-1">#</th>
                <th class="border px-2 py-1">Username (Name)</th>
                <th class="border px-2 py-1">Role</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
            <tr>
                <td class="border px-2 py-1">{{ $loop->iteration + ($users->currentPage()-1)*$users->perPage() }}</td>
                <td class="border px-2 py-1">{{ $u->name }}</td>
                <td class="border px-2 py-1">{{ ucfirst($u->role) }}</td>
                <td class="border px-2 py-1 text-center">
                    @if(auth()->id() !== $u->id)
                        {{-- Form hapus akun --}}
                        <form action="{{ route('accounts.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
                                Hapus
                            </button>
                        </form>
                    @else
                        {{-- Jika ini akun sendiri, tampilkan tanda dash --}}
                        <span class="text-gray-500">—</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center p-4 text-gray-500">Belum ada akun.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination (tanpa panah besar) --}}
    <div class="flex items-center justify-between mt-4">
        <div class="text-sm text-gray-700">
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
        </div>
        <div>
            {{ $users->links('pagination::simple-tailwind') }}
        </div>
    </div>
</div>
@endsection
