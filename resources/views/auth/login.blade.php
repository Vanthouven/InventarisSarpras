<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
        }
        
        .glow {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }
    </style>
</head>
<body class="dark-gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="glass-card rounded-2xl p-8 w-full max-w-md backdrop-blur-lg shadow-2xl">
        <!-- Logo/Icon Area -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-indigo-600 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 glow">
                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-100 mb-2">Welcome Back</h2>
            <p class="text-gray-400">Sign in to continue to your account</p>
        </div>

        @if($errors->any())
            <div class="bg-red-900 bg-opacity-20 border border-red-800 border-opacity-30 text-red-300 px-4 py-3 rounded-xl mb-6 backdrop-blur-sm" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <p>{{ $errors->first() }}</p>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-300">Nama</label>
                <div class="relative">
                    <input 
                        type="text" 
                        name="name" 
                        id="name"
                        value="{{ old('name') }}" 
                        required
                        class="input-focus w-full px-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm"
                        placeholder="Enter your name"
                    >
                </div>
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        required
                        class="input-focus w-full px-4 py-3 bg-gray-900 bg-opacity-50 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm"
                        placeholder="Enter your password"
                    >
                </div>
            </div>

            <div class="pt-4">
                <button 
                    type="submit"
                    class="btn-hover w-full bg-indigo-600 bg-opacity-80 hover:bg-opacity-90 text-white font-semibold py-3 px-6 rounded-xl backdrop-blur-sm border border-indigo-500 border-opacity-30 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-all duration-300"
                >
                    Sign In
                </button>
            </div>
        </form>

        <!-- Additional Links -->
        <!-- <div class="mt-6 text-center">
            <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm transition-all duration-200">
                Forgot your password?
            </a>
        </div> -->
    </div>

    <!-- Floating Elements for Visual Appeal -->
    <div class="fixed top-10 left-10 w-20 h-20 bg-indigo-500 bg-opacity-5 rounded-full blur-xl"></div>
    <div class="fixed bottom-10 right-10 w-32 h-32 bg-indigo-500 bg-opacity-5 rounded-full blur-xl"></div>
    <div class="fixed top-1/2 right-20 w-16 h-16 bg-indigo-500 bg-opacity-5 rounded-full blur-xl"></div>
</body>
</html>