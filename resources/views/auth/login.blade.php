<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    @if($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf

        <label for="role">Role:</label>
        <select name="role" id="role" onchange="toggleFields()">
            <option value="viewer">Viewer</option>
            <option value="petugas" {{ old('role')=='petugas'?'selected':'' }}>Petugas</option>
            <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
        </select>
        <br><br>

        <div id="creds">
            <label for="name">Nama:</label>
            <input type="text" name="name" value="{{ old('name') }}"><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password"><br><br>
        </div>

        <button type="submit">
            @if(old('role','viewer')==='viewer') Login as Viewer @else Login @endif
        </button>
    </form>

    <script>
    function toggleFields() {
        var role = document.getElementById('role').value;
        document.getElementById('creds').style.display = (role === 'viewer') ? 'none' : 'block';
    }
    // inisiasi
    toggleFields();
    </script>
</body>
</html>
