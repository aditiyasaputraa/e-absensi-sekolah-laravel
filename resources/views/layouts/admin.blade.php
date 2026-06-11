<!DOCTYPE html>
<html>
<head>
    <title>Absensi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Absensi Siswa</a>

        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">Dashboard</a>
            <a href="{{ route('siswa.index') }}" class="btn btn-light btn-sm">Data Siswa</a>
            <a href="{{ route('absensi.index') }}" class="btn btn-light btn-sm">Absensi</a>
            <a href="{{ route('absensi.rekap') }}" class="btn btn-light btn-sm">Rekap</a>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>