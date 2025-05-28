<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('content')
<h2>Inventaris</h2>
<form action="{{ route('items.store') }}" method="POST">
    @csrf
    <input type="text" name="namaBarang" placeholder="Nama Item" required>
    <input type="number" name="jumlah" placeholder="Jumlah" required>
    <button type="submit">Tambah</button>
</form>
<ul>
    @foreach ($items as $item)
    <li>{{ $item->namaBarang }} - {{ $item->jumlah }}</li>
    @endforeach
</ul>
@endsection
</body>
</html>