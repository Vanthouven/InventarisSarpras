<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Baru</title>
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
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-100">Buat Akun Baru</h2>
                        <p class="text-gray-400 mt-1">Tambahkan pengguna baru ke sistem inventaris</p>
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
                <form action="{{ route('accounts.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Account Information Section -->
                    <div class="form-section rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-200 mb-6 flex items-center">
                            <svg class="w-5 h-5 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informasi Akun
                        </h3>

                        <div class="space-y-6">
                            <!-- Username -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">Username</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        class="input-focus w-full pl-10 pr-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm" 
                                        placeholder="Masukkan username"
                                        required
                                    >
                                </div>
                                @error('name')
                                    <span class="text-red-400 text-sm flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Role Selection -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">Pilih Role</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <select 
                                        name="role" 
                                        class="input-focus w-full pl-10 pr-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm" 
                                        required
                                    >
                                        <option value="" class="bg-gray-800">-- Pilih Role --</option>
                                        @foreach($roles as $r)
                                            <option value="{{ $r }}" class="bg-gray-800" {{ old('role') === $r ? 'selected' : '' }}>
                                                {{ ucfirst($r) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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
                    </div>

                    <!-- Security Section -->
                    <div class="form-section rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-200 mb-6 flex items-center">
                            <svg class="w-5 h-5 text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Keamanan
                        </h3>

                        <div class="space-y-6">
                            <!-- Password -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password"
                                        class="input-focus w-full pl-10 pr-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm" 
                                        placeholder="Masukkan password"
                                        required
                                        onkeyup="checkPasswordStrength()"
                                    >
                                </div>
                                <!-- Password Strength Indicator -->
                                <div class="mt-2">
                                    <div class="flex space-x-1">
                                        <div id="strength-1" class="password-strength flex-1 bg-gray-700"></div>
                                        <div id="strength-2" class="password-strength flex-1 bg-gray-700"></div>
                                        <div id="strength-3" class="password-strength flex-1 bg-gray-700"></div>
                                        <div id="strength-4" class="password-strength flex-1 bg-gray-700"></div>
                                    </div>
                                    <p id="strength-text" class="text-xs text-gray-500 mt-1">Masukkan password untuk melihat kekuatan</p>
                                </div>
                                @error('password')
                                    <span class="text-red-400 text-sm flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">Konfirmasi Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="password" 
                                        name="password_confirmation" 
                                        id="password_confirmation"
                                        class="input-focus w-full pl-10 pr-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm" 
                                        placeholder="Konfirmasi password"
                                        required
                                        onkeyup="checkPasswordMatch()"
                                    >
                                </div>
                                <div id="password-match" class="text-xs mt-1 hidden">
                                    <span id="match-text"></span>
                                </div>
                                @error('password_confirmation')
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

                    <!-- Submit Section -->
                    <div class="flex justify-end space-x-4">
                        <a 
                            href="{{ route('accounts.index') }}" 
                            class="btn-hover bg-gray-700 bg-opacity-80 hover:bg-opacity-90 text-gray-300 px-6 py-3 rounded-xl backdrop-blur-sm border border-gray-600 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all duration-300 flex items-center space-x-2"
                        >
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            <span>Buat Akun</span>
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

    <script>
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBars = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3'),
                document.getElementById('strength-4')
            ];
            const strengthText = document.getElementById('strength-text');
            
            // Reset all bars
            strengthBars.forEach(bar => {
                bar.className = 'password-strength flex-1 bg-gray-700';
            });
            
            if (password.length === 0) {
                strengthText.textContent = 'Masukkan password untuk melihat kekuatan';
                strengthText.className = 'text-xs text-gray-500 mt-1';
                return;
            }
            
            let strength = 0;
            
            // Check password criteria
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            
            // Update bars and text based on strength
            const colors = ['bg-red-500', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500'];
            const texts = [
                { text: 'Sangat Lemah', class: 'text-xs text-red-400 mt-1' },
                { text: 'Lemah', class: 'text-xs text-yellow-400 mt-1' },
                { text: 'Sedang', class: 'text-xs text-blue-400 mt-1' },
                { text: 'Kuat', class: 'text-xs text-green-400 mt-1' }
            ];
            
            for (let i = 0; i < strength; i++) {
                strengthBars[i].className = `password-strength flex-1 ${colors[strength - 1]}`;
            }
            
            if (strength > 0) {
                strengthText.textContent = texts[strength - 1].text;
                strengthText.className = texts[strength - 1].class;
            }
        }
        
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchDiv = document.getElementById('password-match');
            const matchText = document.getElementById('match-text');
            
            if (confirmPassword.length === 0) {
                matchDiv.classList.add('hidden');
                return;
            }
            
            matchDiv.classList.remove('hidden');
            
            if (password === confirmPassword) {
                matchText.textContent = '✓ Password cocok';
                matchText.className = 'text-green-400 flex items-center';
            } else {
                matchText.textContent = '✗ Password tidak cocok';
                matchText.className = 'text-red-400 flex items-center';
            }
        }
    </script>
    @endsection
</body>
</html>