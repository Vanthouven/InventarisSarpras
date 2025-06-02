<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-nav {
            background: rgba(23, 25, 35, 0.75);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(66, 71, 93, 0.5);
        }
        
        .glass-card {
            background: rgba(30, 32, 47, 0.75);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(66, 71, 93, 0.5);
        }
        
        .dark-gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            min-height: 100vh;
        }
        
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            transform: translateY(-2px);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: rgba(99, 102, 241, 0.8);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }

        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        .glow {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }
        
        .accent-glow {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
        }
    </style>
</head>

<body class="dark-gradient-bg">
    <!-- Navigation -->
    <nav class="glass-nav fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo/Brand -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-8 h-8 bg-indigo-600 bg-opacity-30 rounded-lg flex items-center justify-center mr-3 glow">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                            </svg>
                        </div>
                        <span class="text-gray-100 font-bold text-lg">Inventaris App</span>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('home') }}" class="nav-link text-gray-300 hover:text-indigo-300 px-3 py-2 rounded-md text-sm font-medium">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span>Home</span>
                            </div>
                        </a>

                        <a href="{{ route('borrowings.create') }}" class="nav-link text-gray-300 hover:text-indigo-300 px-3 py-2 rounded-md text-sm font-medium">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span>Peminjaman</span>
                            </div>
                        </a>

                        <a href="{{ route('borrowings.index') }}" class="nav-link text-gray-300 hover:text-indigo-300 px-3 py-2 rounded-md text-sm font-medium">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span>Daftar Peminjaman</span>
                            </div>
                        </a>

                        @auth
                            @if(auth()->user()->role == 'admin')
                                <a href="{{ route('accounts.index') }}" class="nav-link text-gray-300 hover:text-indigo-300 px-3 py-2 rounded-md text-sm font-medium">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                        <span>Manajemen Akun</span>
                                    </div>
                                </a>
                            @endif
                        @endauth

                        @auth
                            @if(auth()->user()->role !== 'viewer')
                                <a href="{{ route('items.index') }}" class="nav-link text-gray-300 hover:text-indigo-300 px-3 py-2 rounded-md text-sm font-medium">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                                        </svg>
                                        <span>Inventaris</span>
                                    </div>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button onclick="toggleMobileMenu()" class="text-gray-300 hover:text-indigo-300 focus:outline-none focus:text-indigo-300">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="mobile-menu md:hidden fixed top-16 left-0 right-0 glass-nav border-t border-gray-700">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="text-gray-300 block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800 hover:bg-opacity-50 hover:text-indigo-300">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Home</span>
                    </div>
                </a>

                <a href="{{ route('borrowings.create') }}" class="text-gray-300 block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800 hover:bg-opacity-50 hover:text-indigo-300">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Peminjaman</span>
                    </div>
                </a>

                <a href="{{ route('borrowings.index') }}" class="text-gray-300 block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800 hover:bg-opacity-50 hover:text-indigo-300">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>Daftar Peminjaman</span>
                    </div>
                </a>

                @auth
                    @if(auth()->user()->role == 'admin')
                        <a href="{{ route('accounts.index') }}" class="text-gray-300 block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800 hover:bg-opacity-50 hover:text-indigo-300">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <span>Manajemen Akun</span>
                            </div>
                        </a>
                    @endif
                @endauth

                @auth
                    @if(auth()->user()->role !== 'viewer')
                        <a href="{{ route('items.index') }}" class="text-gray-300 block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-800 hover:bg-opacity-50 hover:text-indigo-300">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7"></path>
                                </svg>
                                <span>Inventaris</span>
                            </div>
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-16">
        <div class="container mx-auto px-4 py-8">
            @yield('content')
        </div>
    </div>

    <!-- Floating Elements for Visual Appeal -->
    <div class="fixed top-20 left-10 w-20 h-20 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>
    <div class="fixed bottom-10 right-10 w-32 h-32 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>
    <div class="fixed top-1/2 right-20 w-16 h-16 bg-indigo-500 bg-opacity-5 rounded-full blur-xl pointer-events-none"></div>

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('open');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuButton = event.target.closest('button');
            
            if (!mobileMenu.contains(event.target) && !menuButton) {
                mobileMenu.classList.remove('open');
            }
        });
    </script>
</body>

</html>