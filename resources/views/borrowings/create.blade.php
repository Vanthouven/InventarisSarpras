
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

        <!-- Nama Peminjam -->
        <div>
            <label class="block">Nama Peminjam</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="border p-2 w-full" required>
            @error('nama')<span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <!-- Role -->
        <div>
            <label class="block">Role</label>
            <select name="role" id="role" class="border p-2 w-full" required onchange="toggleFields()">
                <option value="">-- Pilih --</option>
                <option value="siswa" {{ old('role')=='siswa'?'selected':'' }}>Siswa</option>
                <option value="guru"  {{ old('role')=='guru'?'selected':'' }}>Guru</option>
            </select>
            @error('role')<span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <!-- Fields for Siswa -->
        <div id="siswa-fields" class="space-y-4 {{ old('role') !== 'siswa' ? 'hidden' : '' }}">
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

        <!-- Pilih Barang dan Jumlah -->
        <div id="items-wrapper" class="space-y-2">
            <label class="block font-semibold">Barang yang Dipinjam</label>
            <div class="item-row flex space-x-2 items-center">
                <select name="items[]" class="border p-2 flex-1" required>
                    <option value="">-- Pilih barang --</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ (old('items') && in_array($item->id, old('items'))) ? 'selected' : '' }}>
                            (nama item: {{ $item->namaBarang }}) (stok: {{ $item->jumlah }})
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantity[]" min="1" value="{{ old('quantity.0', 1) }}" placeholder="Jumlah" class="border p-2 w-24" required>
                <!-- <button type="button" class="remove-item bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">–</button> ini juga aktifkan bila perlu-->
            </div>
            @error('items')<span class="text-red-500">{{ $message }}</span>@enderror
            @error('items.*')<span class="text-red-500">{{ $message }}</span>@enderror
            @error('quantity.*')<span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <!-- <button type="button" id="add-item" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Barang
        </button> aktifkan bial perlu-->

        <!-- Submit -->
        <div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">Submit</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Toggle fields untuk siswa
    function toggleSiswaFields() {
        const role = document.getElementById('role').value;
        document.getElementById('siswa-fields').classList.toggle('hidden', role !== 'siswa');
    }
    document.getElementById('role').addEventListener('change', toggleSiswaFields);
    toggleSiswaFields();

    // Tambah / hapus baris barang
    document.getElementById('add-item').addEventListener('click', () => {
        const wrapper = document.getElementById('items-wrapper');
        const row = wrapper.querySelector('.item-row').cloneNode(true);
        // Reset nilai
        row.querySelector('select').value = '';
        row.querySelector('input').value = 1;
        wrapper.appendChild(row);
    });

    document.getElementById('items-wrapper').addEventListener('click', e => {
        if (e.target.classList.contains('remove-item')) {
            const rows = document.querySelectorAll('.item-row');
            if (rows.length > 1) {
                e.target.closest('.item-row').remove();
            }
        }
    });

    function toggleFields() {
        var role = document.getElementById('role').value;
        document.getElementById('siswa-fields').style.display = (role === 'guru') ? 'none' : 'block';
    }
    // inisiasi
    toggleFields();
</script>
@endpush
