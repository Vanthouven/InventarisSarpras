<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Pertama</title>
    {{-- Load CSS/Tailwind (jika diperlukan) --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head><body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl mb-4 text-center">Buat Akun Admin Pertama</h2>

            {{-- Tampilkan error validation (jika ada) --}}
            @if($errors->any())
                <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('accounts.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Username --}}
                <div>
                    <label class="block font-medium">Username</label>
                    <input type="text" name="name"
                           class="border p-2 w-full rounded"
                           value="{{ old('name') }}"
                           required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block font-medium">Password</label>
                    <input type="password" name="password"
                           class="border p-2 w-full rounded"
                           required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block font-medium">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                           class="border p-2 w-full rounded"
                           required>
                </div>

                {{-- Pilih Role --}}
                <div>
                    <label class="block font-medium">Pilih Role</label>
                    <select name="role" class="border p-2 w-full rounded" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                    </select>
                    @error('role')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tombol Submit --}}
                <div class="text-right">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Buat Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</body></html>
