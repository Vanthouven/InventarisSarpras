<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h2>Dashboard Inventaris</h2>
        <div class="stats">
            <p>Total Barang: {{ $total_items }}</p>
            <p>Terbaru: {{ $latest_item->nama ?? 'Belum ada data' }}</p>
        </div>
        <!-- <a href="{{ route('items.index') }}" class="btn btn-primary">Lihat Inventaris</a> -->
    </div>
    @endsection
</body>

</html>