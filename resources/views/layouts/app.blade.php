<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Inventaris</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('borrowings.create') }}">Peminjaman</a>
        <a href="{{ route('borrowings.index') }}">Daftar Peminjaman</a>

        @auth
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('accounts.index') }}">Manajemen Akun</a>
            @endif
        @endauth

        @auth
            @if(auth()->user()->role !== 'viewer')
                <a href="{{ route('items.index') }}">Inventaris</a>
                <!-- <a href="{{ route('dashboard') }}">Dashboard</a> -->
            @endif
        @endauth
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>