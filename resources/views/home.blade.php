<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
        }

        .role-badge {
            background: linear-gradient(45deg, rgba(99, 102, 241, 0.3), rgba(99, 102, 241, 0.1));
        }
        
        .glow {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }
        
        .card-glow {
            box-shadow: 0 0 20px rgba(30, 32, 47, 0.5);
        }
    </style>
</head>
<body class="dark-gradient-bg min-h-screen">
    @extends('layouts.app')
    
    @section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="glass-card rounded-2xl p-8 w-full max-w-2xl backdrop-blur-lg shadow-2xl card-glow">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-indigo-600 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 glow">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-100 mb-4">
                    Welcome Back!
                </h1>
                <div class="flex items-center justify-center space-x-3 mb-2">
                    <span class="text-gray-300 text-opacity-90 text-xl">
                        {{ $user->name ?? 'Guest' }}
                    </span>
                    <span class="role-badge px-3 py-1 rounded-full text-indigo-200 text-sm font-medium border border-indigo-500 border-opacity-30">
                        {{ $user->role }}
                    </span>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-gray-900 bg-opacity-50 rounded-xl p-6 mb-8 backdrop-blur-sm border border-gray-700">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-indigo-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-100">Information</h2>
                </div>
                <p class="text-gray-400 text-lg leading-relaxed">
                    You are currently logged in as a <strong class="text-indigo-300">{{ $user->role }}</strong> user. 
                    This is your personalized dashboard where you can access all the features available for your role.
                </p>
            </div>

            <!-- Quick Stats or Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="bg-gray-900 bg-opacity-50 rounded-xl p-4 backdrop-blur-sm border border-gray-700">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-indigo-600 bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-gray-200 font-semibold">User Role</h3>
                            <p class="text-gray-400 text-sm">{{ $user->role }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-900 bg-opacity-50 rounded-xl p-4 backdrop-blur-sm border border-gray-700">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-indigo-600 bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-gray-200 font-semibold">Status</h3>
                            <p class="text-gray-400 text-sm">Active Session</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logout Section -->
            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button 
                        type="submit"
                        class="btn-hover bg-red-900 bg-opacity-50 hover:bg-opacity-70 text-red-200 font-semibold py-3 px-8 rounded-xl backdrop-blur-sm border border-red-800 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-50 transition-all duration-300 flex items-center space-x-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Floating Elements for Visual Appeal -->
    <div class="fixed top-10 left-10 w-20 h-20 bg-indigo-500 bg-opacity-5 rounded-full blur-xl"></div>
    <div class="fixed bottom-10 right-10 w-32 h-32 bg-indigo-500 bg-opacity-5 rounded-full blur-xl"></div>
    <div class="fixed top-1/2 right-20 w-16 h-16 bg-indigo-500 bg-opacity-5 rounded-full blur-xl"></div>
    @endsection
</body>
</html>