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
        <a href="{{ route('items.index') }}">Inventaris</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>