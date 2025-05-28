<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    @extends('layouts.app')
    
    @section('content')
    <h1>Welcome, {{ $user->role }} {{ $user->name ?? 'Guest' }}!</h1>
    <p>Ini halaman home untuk role <strong>{{ $user->role }}</strong>.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @endsection
</body>
</html>
