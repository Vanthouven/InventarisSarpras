<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman</title>
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
        
        .slide-down {
            transition: all 0.3s ease;
            max-height: 500px;
            opacity: 1;
        }
        
        .slide-up {
            transition: all 0.3s ease;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }
    </style>
</head>
<body class="dark-gradient-bg">
    @extends('layouts.app')

    @section('content')
    <div class="container mx-auto p-4 pt-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="glass-card rounded-2xl p-6 mb-6 backdrop-blur-lg shadow-2xl">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-indigo-600 bg-opacity-20 rounded-lg flex items-center justify-center mr-4 glow">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-100">Form Peminjaman Barang</h2>
                </div>
                <p class="text-gray-400">Silakan isi form di bawah ini untuk meminjam barang inventaris</p>
            </div>

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

            <!-- Main Form -->
            <div class="glass-card rounded-2xl p-8 backdrop-blur-lg shadow-2xl">
                <form action="{{ route('borrowings.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="form-section rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-200 mb-6 flex items-center">
                            <svg class="w-5 h-5 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informasi Peminjam
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Peminjam -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">Nama Peminjam</label>
                                <input 
                                    type="text" 
                                    name="nama" 
                                    value="{{ old('nama') }}" 
                                    class="input-focus w-full px-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm" 
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >
                                @error('nama')
                                    <span class="text-red-400 text-sm flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">Role</label>
                                <select 
                                    name="role" 
                                    id="role" 
                                    class="input-focus w-full px-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm" 
                                    required 
                                    onchange="toggleSiswaFields()"
                                >
                                    <option value="" class="bg-gray-800">-- Pilih Role --</option>
                                    <option value="siswa" class="bg-gray-800" {{ old('role')=='siswa'?'selected':'' }}>Siswa</option>
                                    <option value="guru" class="bg-gray-800" {{ old('role')=='guru'?'selected':'' }}>Guru</option>
                                </select>
                                @error('role')
                                    <span class="text-red-400 text-sm flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Fields for Siswa -->
                        <div id="siswa-fields" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6 {{ old('role') !== 'siswa' ? 'slide-up' : 'slide-down' }}">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">Jurusan</label>
                                <select 
                                    name="jurusan" 
                                    class="input-focus w-full px-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm"
                                >
                                    <option value="" class="bg-gray-800">-- Pilih Jurusan --</option>
                                    @foreach($jurusan as $j)
                                        <option value="{{ $j }}" class="bg-gray-800" {{ old('jurusan')==$j?'selected':'' }}>{{ $j }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan')
                                    <span class="text-red-400 text-sm flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">Kelas</label>
                                <select 
                                    name="kelas" 
                                    class="input-focus w-full px-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm"
                                >
                                    <option value="" class="bg-gray-800">-- Pilih Kelas --</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k }}" class="bg-gray-800" {{ old('kelas')==$k?'selected':'' }}>{{ $k }}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <span class="text-red-400 text-sm flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Items Selection Section -->
                    <div class="form-section rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-200 mb-6 flex items-center">
                            <svg class="w-5 h-5 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                            </svg>
                            Barang yang Dipinjam
                        </h3>

                        <div id="items-wrapper" class="space-y-4">
                            <div class="item-row">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                    <div class="md:col-span-2 space-y-2">
                                        <label class="block text-sm font-medium text-gray-300">Pilih Barang</label>
                                        <select 
                                            name="items[]" 
                                            class="input-focus w-full px-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm" 
                                            required
                                        >
                                            <option value="" class="bg-gray-800">-- Pilih barang --</option>
                                            @foreach($items as $item)
                                                <option value="{{ $item->id }}" class="bg-gray-800" {{ (old('items') && in_array($item->id, old('items'))) ? 'selected' : '' }}>
                                                    {{ $item->namaBarang }} (Stok: {{ $item->jumlah }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-300">Jumlah</label>
                                        <input 
                                            type="number" 
                                            name="quantity[]" 
                                            min="1" 
                                            value="{{ old('quantity.0', 1) }}" 
                                            placeholder="Qty" 
                                            class="input-focus w-full px-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm" 
                                            required
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        @error('items')
                            <span class="text-red-400 text-sm flex items-center mt-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </span>
                        @enderror
                        @error('items.*')
                            <span class="text-red-400 text-sm flex items-center mt-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </span>
                        @enderror
                        @error('quantity.*')
                            <span class="text-red-400 text-sm flex items-center mt-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <!-- Submit Section -->
                    <div class="flex justify-end space-x-4">
                        <button 
                            type="submit" 
                            class="btn-hover bg-green-600 bg-opacity-80 hover:bg-opacity-90 text-white px-8 py-3 rounded-xl backdrop-blur-sm border border-green-500 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300 flex items-center space-x-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Submit Peminjaman</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Floating Elements for Visual Appeal -->
    <div class="fixed top-20 left-10 w-20 h-20 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>
    <div class="fixed bottom-10 right-10 w-32 h-32 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>
    <div class="fixed top-1/2 right-20 w-16 h-16 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>
    @endsection

    @push('scripts')
    <script>
        // Single function to toggle siswa fields with smooth animation
        function toggleSiswaFields() {
            const role = document.getElementById('role').value;
            const siswaFields = document.getElementById('siswa-fields');
            
            if (role === 'siswa') {
                siswaFields.classList.remove('slide-up');
                siswaFields.classList.add('slide-down');
            } else {
                siswaFields.classList.remove('slide-down');
                siswaFields.classList.add('slide-up');
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleSiswaFields();
        });

        // Add event listener to role select
        document.getElementById('role').addEventListener('change', toggleSiswaFields);
    </script>
    @endpush
</body>
</html>
