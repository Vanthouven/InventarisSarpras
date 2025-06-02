<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-card {
            background: rgba(30, 32, 47, 0.75);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(66, 71, 93, 0.5);
        }
        
        .dark-gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
        }
        
        .table-row:hover {
            background: rgba(99, 102, 241, 0.1);
            transition: all 0.3s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
        }
        
        .glow {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }
        
        .status-badge {
            backdrop-filter: blur(5px);
        }
        
        .table-header {
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body class="dark-gradient-bg">
    @extends('layouts.app')

    @section('content')
    <div class="container mx-auto p-4 pt-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="glass-card rounded-2xl p-6 mb-6 backdrop-blur-lg shadow-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-indigo-600 bg-opacity-20 rounded-lg flex items-center justify-center mr-4 glow">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-100">Daftar Peminjaman</h2>
                            <p class="text-gray-400 mt-1">Kelola dan pantau semua peminjaman barang inventaris</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <div class="text-2xl font-bold text-indigo-400">{{ $borrowings->total() }}</div>
                            <div class="text-sm text-gray-400">Total Peminjaman</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="glass-card rounded-2xl backdrop-blur-lg shadow-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="table-header">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">#</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Nama</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Role</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Jurusan</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Kelas</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Barang Dipinjam</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Jumlah</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @forelse($borrowings as $b)
                            <tr class="table-row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 border-b border-gray-800">
                                    <div class="flex items-center justify-center w-8 h-8 bg-indigo-600 bg-opacity-20 rounded-full text-indigo-400 font-semibold">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-800">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-medium text-gray-200">{{ $b->nama }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-800">
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                        {{ $b->role === 'siswa' ? 'bg-blue-900 bg-opacity-50 text-blue-300 border border-blue-700' : 'bg-purple-900 bg-opacity-50 text-purple-300 border border-purple-700' }}">
                                        {{ ucfirst($b->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 border-b border-gray-800">
                                    {{ $b->jurusan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 border-b border-gray-800">
                                    {{ $b->kelas ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 border-b border-gray-800">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $b->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 border-b border-gray-800">
                                    @if($b->items->count())
                                        <div class="space-y-1">
                                            @foreach($b->items as $item)
                                                <div class="flex items-center text-sm text-gray-300">
                                                    <div class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></div>
                                                    {{ $item->namaBarang }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 border-b border-gray-800">
                                    @if($b->items->count())
                                        <div class="space-y-1">
                                            @foreach($b->items as $item)
                                                <div class="flex items-center justify-center w-8 h-6 bg-gray-700 rounded text-xs text-gray-300 font-medium">
                                                    {{ $item->pivot->quantity }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-800">
                                    @auth
                                    @if(auth()->user()->role !== 'viewer')
                                        @if($b->status === 'belum_kembali')
                                            <form action="{{ route('borrowings.return', $b->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button 
                                                    type="submit" 
                                                    class="btn-hover bg-blue-600 bg-opacity-80 hover:bg-opacity-90 text-white px-4 py-2 rounded-lg backdrop-blur-sm border border-blue-500 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 flex items-center space-x-2 text-sm"
                                                    onclick="return confirm('Tandai peminjaman ini sebagai sudah kembali?');"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span>Sudah Kembali</span>
                                                </button>
                                            </form>
                                        @else
                                            <span class="status-badge inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-900 bg-opacity-50 text-green-300 border border-green-700">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Sudah Kembali
                                            </span>
                                        @endif
                                    @else
                                        @if($b->status === 'belum_kembali')
                                            <span class="status-badge inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-900 bg-opacity-50 text-yellow-300 border border-yellow-700">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Belum Kembali
                                            </span>
                                        @else
                                            <span class="status-badge inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-900 bg-opacity-50 text-green-300 border border-green-700">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Sudah Kembali
                                            </span>
                                        @endif
                                    @endif
                                    @endauth
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center border-b border-gray-800">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-400 mb-2">Tidak ada data peminjaman</h3>
                                        <p class="text-gray-500">Belum ada peminjaman yang tercatat dalam sistem.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination and Summary -->
                @if($borrowings->hasPages() || $borrowings->total() > 0)
                <div class="bg-gray-900 bg-opacity-50 px-6 py-4 border-t border-gray-700">
                    <div class="flex items-center justify-between">
                        <!-- Summary -->
                        <div class="flex items-center text-sm text-gray-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Showing 
                            <span class="font-medium text-gray-300 mx-1">{{ $borrowings->firstItem() ?? 0 }}</span>
                            to 
                            <span class="font-medium text-gray-300 mx-1">{{ $borrowings->lastItem() ?? 0 }}</span>
                            of 
                            <span class="font-medium text-gray-300 mx-1">{{ $borrowings->total() }}</span>
                            results
                        </div>

                        <!-- Pagination -->
                        @if($borrowings->hasPages())
                        <div class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($borrowings->onFirstPage())
                                <span class="px-3 py-2 text-sm text-gray-500 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700 cursor-not-allowed">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $borrowings->previousPageUrl() }}" class="px-3 py-2 text-sm text-gray-300 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700 hover:bg-opacity-70 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            <span class="px-3 py-2 text-sm text-gray-300 bg-indigo-600 bg-opacity-50 rounded-lg border border-indigo-500">
                                {{ $borrowings->currentPage() }}
                            </span>

                            <span class="text-gray-500">of</span>

                            <span class="px-3 py-2 text-sm text-gray-400">
                                {{ $borrowings->lastPage() }}
                            </span>

                            {{-- Next Page Link --}}
                            @if ($borrowings->hasMorePages())
                                <a href="{{ $borrowings->nextPageUrl() }}" class="px-3 py-2 text-sm text-gray-300 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700 hover:bg-opacity-70 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @else
                                <span class="px-3 py-2 text-sm text-gray-500 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700 cursor-not-allowed">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Floating Elements for Visual Appeal -->
    <div class="fixed top-20 left-10 w-20 h-20 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>
    <div class="fixed bottom-10 right-10 w-32 h-32 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>
    <div class="fixed top-1/2 right-20 w-16 h-16 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>
    @endsection
</body>
</html>