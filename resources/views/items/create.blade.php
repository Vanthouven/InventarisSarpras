<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item Baru</title>
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
        
        .input-focus:focus {
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
        }
        
        .glow {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }
        
        .form-section {
            background: rgba(17, 24, 39, 0.5);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(75, 85, 99, 0.3);
        }
    </style>
</head>
<body class="dark-gradient-bg">
    @extends('layouts.app')

    @section('content')
    <div class="container mx-auto p-4 pt-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header Section -->
            <div class="glass-card rounded-2xl p-6 mb-6 backdrop-blur-lg shadow-2xl">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-indigo-600 bg-opacity-20 rounded-lg flex items-center justify-center mr-4 glow">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-100">Tambah Item Baru</h2>
                        <p class="text-gray-400 mt-1">Tambahkan barang baru ke inventaris</p>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="glass-card rounded-xl p-4 mb-6 border-red-500 border-opacity-30 bg-red-900 bg-opacity-20">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-red-300 font-medium mb-2">Terdapat kesalahan pada form:</h3>
                            <ul class="list-disc list-inside space-y-1 text-red-300 text-sm">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Form -->
            <div class="glass-card rounded-2xl p-8 backdrop-blur-lg shadow-2xl">
                <form action="{{ route('items.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Item Information Section -->
                    <div class="form-section rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-200 mb-6 flex items-center">
                            <svg class="w-5 h-5 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                            </svg>
                            Informasi Barang
                        </h3>

                        <div class="space-y-6">
                            <!-- Nama Barang -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">Nama Barang</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="namaBarang" 
                                        value="{{ old('namaBarang') }}" 
                                        class="input-focus w-full pl-10 pr-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm" 
                                        placeholder="Masukkan nama barang"
                                        required
                                    >
                                </div>
                                @error('namaBarang')
                                    <span class="text-red-400 text-sm flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Jumlah -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">Jumlah Stok</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="number" 
                                        name="jumlah" 
                                        value="{{ old('jumlah', 0) }}" 
                                        min="0" 
                                        class="input-focus w-full pl-10 pr-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm" 
                                        placeholder="Masukkan jumlah stok"
                                        required
                                        id="stock-input"
                                    >
                                </div>
                                @error('jumlah')
                                    <span class="text-red-400 text-sm flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                                
                                <!-- Stock Level Indicator -->
                                <div class="mt-2">
                                    <div class="text-xs text-gray-500 mb-1">Level stok:</div>
                                    <div class="flex space-x-2">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-red-500 rounded-full mr-1"></div>
                                            <span class="text-xs text-gray-400">< 5 (Kritis)</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-1"></div>
                                            <span class="text-xs text-gray-400">5-9 (Rendah)</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-green-500 rounded-full mr-1"></div>
                                            <span class="text-xs text-gray-400">≥ 10 (Baik)</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Stock Level Preview -->
                                <div class="mt-4 bg-gray-900 bg-opacity-50 rounded-lg p-4 border border-gray-700">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-400">Status stok:</div>
                                        <div id="stock-status" class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-900 bg-opacity-50 text-red-300 border border-red-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                            </svg>
                                            <span id="stock-text">Stok Kritis (0)</span>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full bg-gray-700 rounded-full h-2">
                                        <div id="stock-bar" class="bg-red-500 h-2 rounded-full" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Presets Section -->
                    <div class="form-section rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-200 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Set Jumlah Cepat
                        </h3>
                        
                        <div class="grid grid-cols-4 gap-2">
                            <button type="button" onclick="setStock(5)" class="btn-hover bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-2 rounded-lg border border-gray-700 focus:outline-none transition-all duration-200">5</button>
                            <button type="button" onclick="setStock(10)" class="btn-hover bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-2 rounded-lg border border-gray-700 focus:outline-none transition-all duration-200">10</button>
                            <button type="button" onclick="setStock(20)" class="btn-hover bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-2 rounded-lg border border-gray-700 focus:outline-none transition-all duration-200">20</button>
                            <button type="button" onclick="setStock(50)" class="btn-hover bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-2 rounded-lg border border-gray-700 focus:outline-none transition-all duration-200">50</button>
                        </div>
                    </div>

                    <!-- Submit Section -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('items.index') }}" 
                           class="btn-hover bg-gray-700 bg-opacity-80 hover:bg-opacity-90 text-gray-300 px-6 py-3 rounded-xl backdrop-blur-sm border border-gray-600 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all duration-300 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Batal</span>
                        </a>
                        
                        <button 
                            type="submit" 
                            class="btn-hover bg-green-600 bg-opacity-80 hover:bg-opacity-90 text-white px-8 py-3 rounded-xl backdrop-blur-sm border border-green-500 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300 flex items-center space-x-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Tambah Item</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Additional Info Card -->
            <div class="glass-card rounded-xl p-4 mt-6 backdrop-blur-lg shadow-lg">
                <div class="flex items-center text-sm text-gray-400">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Item yang ditambahkan akan langsung tersedia untuk peminjaman</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Elements for Visual Appeal -->
    <div class="fixed top-20 left-10 w-20 h-20 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>
    <div class="fixed bottom-10 right-10 w-32 h-32 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>
    <div class="fixed top-1/2 right-20 w-16 h-16 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>

    <script>
        // Real-time stock level indicator
        const stockInput = document.getElementById('stock-input');
        const stockStatus = document.getElementById('stock-status');
        const stockText = document.getElementById('stock-text');
        const stockBar = document.getElementById('stock-bar');
        
        function updateStockIndicator() {
            const value = parseInt(stockInput.value) || 0;
            const indicators = document.querySelectorAll('.w-3.h-3');
            
            // Reset all indicators
            indicators.forEach(indicator => {
                indicator.style.opacity = '0.3';
            });
            
            // Update stock bar (max 100 units = 100%)
            const percentage = Math.min(value, 100);
            stockBar.style.width = `${percentage}%`;
            
            // Update status text and colors
            if (value < 5) {
                indicators[0].style.opacity = '1'; // Red
                stockStatus.className = 'inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-900 bg-opacity-50 text-red-300 border border-red-700';
                stockText.innerHTML = `Stok Kritis (${value})`;
                stockBar.className = 'bg-red-500 h-2 rounded-full';
            } else if (value < 10) {
                indicators[1].style.opacity = '1'; // Yellow
                stockStatus.className = 'inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-900 bg-opacity-50 text-yellow-300 border border-yellow-700';
                stockText.innerHTML = `Stok Rendah (${value})`;
                stockBar.className = 'bg-yellow-500 h-2 rounded-full';
            } else {
                indicators[2].style.opacity = '1'; // Green
                stockStatus.className = 'inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-900 bg-opacity-50 text-green-300 border border-green-700';
                stockText.innerHTML = `Stok Baik (${value})`;
                stockBar.className = 'bg-green-500 h-2 rounded-full';
            }
        }
        
        function setStock(value) {
            stockInput.value = value;
            updateStockIndicator();
        }
        
        stockInput.addEventListener('input', updateStockIndicator);
        
        // Initialize on page load
        updateStockIndicator();
    </script>
    @endsection
</body>
</html>