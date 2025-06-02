<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
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
        
        .btn-edit:hover {
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .glow {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }
        
        .table-header {
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(5px);
        }
        
        .form-section {
            background: rgba(17, 24, 39, 0.5);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(75, 85, 99, 0.3);
        }
        
        .warning-glow {
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.3);
        }
        
        .input-focus:focus {
            transform: translateY(-1px);
            transition: all 0.3s ease;
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-100">Inventaris</h2>
                            <p class="text-gray-400 mt-1">Kelola barang dan stok inventaris</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <div class="text-right">
                            <div class="text-2xl font-bold text-indigo-400">{{ $items->count() }}</div>
                            <div class="text-sm text-gray-400">Total Item</div>
                        </div>
                        @if(isset($lowStock) && $lowStock->count() > 0)
                        <div class="text-right">
                            <div class="text-2xl font-bold text-yellow-400">{{ $lowStock->count() }}</div>
                            <div class="text-sm text-gray-400">Stok Rendah</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Add Item Form -->
            <div class="glass-card rounded-2xl p-6 mb-6 backdrop-blur-lg shadow-xl">
                <div class="form-section rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-gray-200 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Barang Baru
                    </h3>
                    
                    <form action="{{ route('items.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        @csrf
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-300">Nama Barang</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    name="namaBarang"
                                    placeholder="Masukkan nama barang"
                                    required
                                    class="input-focus w-full pl-10 pr-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm"
                                >
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-300">Jumlah</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                    </svg>
                                </div>
                                <input
                                    type="number"
                                    name="jumlah"
                                    placeholder="Qty"
                                    required
                                    min="0"
                                    class="input-focus w-full pl-10 pr-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm"
                                >
                            </div>
                        </div>
                        
                        <div>
                            <button
                                type="submit"
                                class="btn-hover w-full bg-green-600 bg-opacity-80 hover:bg-opacity-90 text-white px-6 py-3 rounded-xl backdrop-blur-sm border border-green-500 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300 flex items-center justify-center space-x-2"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span>Tambah</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Low Stock Warning -->
            @if(isset($lowStock) && $lowStock->count() > 0)
                <div class="glass-card rounded-xl p-4 mb-6 border-yellow-500 border-opacity-30 bg-yellow-900 bg-opacity-20 warning-glow">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-yellow-400 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <h3 class="text-yellow-300 font-semibold mb-2 flex items-center">
                                <span>⚠ Peringatan: Stok Hampir Habis</span>
                            </h3>
                            <div class="space-y-2">
                                @foreach($lowStock as $low)
                                    <div class="flex items-center justify-between bg-yellow-800 bg-opacity-30 rounded-lg p-3">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-yellow-400 rounded-full mr-3"></div>
                                            <span class="text-yellow-200 font-medium">{{ $low->namaBarang }}</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-yellow-300 text-sm">Sisa:</span>
                                            <span class="bg-yellow-600 bg-opacity-50 text-yellow-200 px-2 py-1 rounded-full text-sm font-semibold">
                                                {{ $low->jumlah }} unit
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Items Table -->
            <div class="glass-card rounded-2xl backdrop-blur-lg shadow-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="table-header">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">#</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Nama Barang</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Stok</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-300 uppercase tracking-wider border-b border-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @forelse ($items as $item)
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 border-b border-gray-800">
                                        <div class="flex items-center justify-center w-8 h-8 bg-indigo-600 bg-opacity-20 rounded-full text-indigo-400 font-semibold">
                                            {{ $loop->iteration }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-800">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gray-700 rounded-lg flex items-center justify-center mr-4">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-200">{{ $item->namaBarang }}</div>
                                                <div class="text-xs text-gray-500">ID: {{ $item->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-800">
                                        @if($item->jumlah < 5)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-900 bg-opacity-50 text-red-300 border border-red-700">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                </svg>
                                                {{ $item->jumlah }} unit
                                            </span>
                                        @elseif($item->jumlah < 10)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-900 bg-opacity-50 text-yellow-300 border border-yellow-700">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $item->jumlah }} unit
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-900 bg-opacity-50 text-green-300 border border-green-700">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                {{ $item->jumlah }} unit
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center border-b border-gray-800">
                                        <div class="flex items-center justify-center space-x-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('items.edit', $item->id) }}"
                                               class="btn-hover btn-edit bg-blue-600 bg-opacity-80 hover:bg-opacity-90 text-white px-4 py-2 rounded-lg backdrop-blur-sm border border-blue-500 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                <span>Edit</span>
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus {{ $item->namaBarang }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn-hover btn-danger bg-red-600 bg-opacity-80 hover:bg-opacity-90 text-white px-4 py-2 rounded-lg backdrop-blur-sm border border-red-500 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-300 flex items-center space-x-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center border-b border-gray-800">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                                            </svg>
                                            <h3 class="text-lg font-medium text-gray-400 mb-2">Tidak ada item</h3>
                                            <p class="text-gray-500">Belum ada barang yang terdaftar dalam inventaris.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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