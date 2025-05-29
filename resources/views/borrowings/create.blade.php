<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
</head>
<body>
    @extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4">Form Peminjaman Barang</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('borrowings.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block">Nama Peminjam</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="border p-2 w-full" required>
            @error('nama')<span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <div>
            <label class="block">Role</label>
            <select name="role" id="role" class="border p-2 w-full" required>
                <option value="">-- Pilih --</option>
                <option value="siswa" {{ old('role')=='siswa'?'selected':'' }}>Siswa</option>
                <option value="guru"  {{ old('role')=='guru' ?'selected':'' }}>Guru</option>
            </select>
            @error('role')<span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <div id="siswa-fields" class="hidden space-y-4">
            <div>
                <label class="block">Jurusan</label>
                <select name="jurusan" class="border p-2 w-full">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j }}" {{ old('jurusan')==$j?'selected':'' }}>{{ $j }}</option>
                    @endforeach
                </select>
                @error('jurusan')<span class="text-red-500">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block">Kelas</label>
                <select name="kelas" class="border p-2 w-full">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k }}" {{ old('kelas')==$k?'selected':'' }}>{{ $k }}</option>
                    @endforeach
                </select>
                @error('kelas')<span class="text-red-500">{{ $message }}</span>@enderror
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
    </form>
</div>

<script>
    function toggleSiswaFields() {
        var nilai = document.getElementById('role').value;
        document.getElementById('siswa-fields')
            .classList.toggle('hidden', nilai !== 'siswa');
    }

    document.getElementById('role').addEventListener('change', toggleSiswaFields);
    toggleSiswaFields();
</script>
@endsection
</body>
</html>