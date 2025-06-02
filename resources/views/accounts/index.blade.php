<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun</title>
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
        
        .btn-danger:hover {
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        
        .glow {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }
        
        .table-header {
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(5px);
        }
        
        .role-badge {
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body class="dark-gradient-bg">
    @extends('layouts.app')

    @section('content')
    <div class="container mx-auto p-4 pt-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="glass-card rounded-2xl p-6 mb-6 backdrop-blur-lg shadow-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-indigo-600 bg-opacity-20 rounded-lg flex items-center justify-center mr-4 glow">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-100">Manajemen Akun</h2>
                            <p class="text-gray-400 mt-1">Kelola pengguna dan hak akses sistem inventaris</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <div class="text-2xl font-bold text-indigo-400">{{ $users->total() }}</div>
                            <div class="text-sm text-gray-400">Total Pengguna</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="glass-card rounded-xl p-4 mb-6 border-green-500 border-opacity-30 bg-green-900 bg-opacity-20">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-green-300">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="glass-card rounded-xl p-4 mb-6 border-red-500 border-opacity-30 bg-red-900 bg-opacity-20">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-red-300">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Action Bar -->
            <div class="glass-card rounded-xl p-4 mb-6 backdrop-blur-lg shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a 
                            href="{{ route('accounts.create') }}" 
                            class="btn-hover bg-indigo-600 bg-opacity-80 hover:bg-opacity-90 text-white px-6 py-3 rounded-xl backdrop-blur-sm border border-indigo-500 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300 flex items-center space-x-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            <span>Buat Akun Baru</span>
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-2 text-sm text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Anda tidak dapat menghapus akun sendiri</span>
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
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Username</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Role</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @forelse($users as $u)
                            <tr class="table-row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 border-b border-gray-800">
                                    <div class="flex items-center justify-center w-8 h-8 bg-indigo-600 bg-opacity-20 rounded-full text-indigo-400 font-semibold">
                                        {{ $loop->iteration + ($users->currentPage()-1)*$users->perPage() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-800">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center mr-4">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-200">{{ $u->name }}</div>
                                            @if(auth()->id() === $u->id)
                                                <div class="text-xs text-indigo-400 flex items-center mt-1">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Akun Anda
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-800">
                                    <span class="role-badge inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($u->role === 'admin') bg-purple-900 bg-opacity-50 text-purple-300 border border-purple-700
                                        @elseif($u->role === 'staff') bg-blue-900 bg-opacity-50 text-blue-300 border border-blue-700
                                        @elseif($u->role === 'viewer') bg-gray-700 bg-opacity-50 text-gray-300 border border-gray-600
                                        @else bg-green-900 bg-opacity-50 text-green-300 border border-green-700
                                        @endif">
                                        @if($u->role === 'admin')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                        @elseif($u->role === 'staff')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0H8m8 0v6a2 2 0 01-2 2H10a2 2 0 01-2-2V6m8 0V4a2 2 0 00-2-2H10a2 2 0 00-2 2v2"></path>
                                            </svg>
                                        @elseif($u->role === 'viewer')
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        @endif
                                        {{ ucfirst($u->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center border-b border-gray-800">
                                    @if(auth()->id() !== $u->id)
                                        <form action="{{ route('accounts.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="btn-hover btn-danger bg-red-600 bg-opacity-80 hover:bg-opacity-90 text-white px-4 py-2 rounded-lg backdrop-blur-sm border border-red-500 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-300 flex items-center space-x-2"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    @else
                                        <div class="flex items-center justify-center">
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gray-700 bg-opacity-50 text-gray-400 border border-gray-600">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                                </svg>
                                                Tidak dapat dihapus
                                            </span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center border-b border-gray-800">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-400 mb-2">Tidak ada pengguna</h3>
                                        <p class="text-gray-500">Belum ada akun yang terdaftar dalam sistem.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination and Summary -->
                @if($users->hasPages() || $users->total() > 0)
                <div class="bg-gray-900 bg-opacity-50 px-6 py-4 border-t border-gray-700">
                    <div class="flex items-center justify-between">
                        <!-- Summary -->
                        <div class="flex items-center text-sm text-gray-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Showing 
                            <span class="font-medium text-gray-300 mx-1">{{ $users->firstItem() ?? 0 }}</span>
                            to 
                            <span class="font-medium text-gray-300 mx-1">{{ $users->lastItem() ?? 0 }}</span>
                            of 
                            <span class="font-medium text-gray-300 mx-1">{{ $users->total() }}</span>
                            results
                        </div>

                        <!-- Pagination -->
                        @if($users->hasPages())
                        <div class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($users->onFirstPage())
                                <span class="px-3 py-2 text-sm text-gray-500 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700 cursor-not-allowed">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $users->previousPageUrl() }}" class="px-3 py-2 text-sm text-gray-300 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700 hover:bg-opacity-70 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            <span class="px-3 py-2 text-sm text-gray-300 bg-indigo-600 bg-opacity-50 rounded-lg border border-indigo-500">
                                {{ $users->currentPage() }}
                            </span>

                            <span class="text-gray-500">of</span>

                            <span class="px-3 py-2 text-sm text-gray-400">
                                {{ $users->lastPage() }}
                            </span>

                            {{-- Next Page Link --}}
                            @if ($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}" class="px-3 py-2 text-sm text-gray-300 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700 hover:bg-opacity-70 transition-all duration-200">
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