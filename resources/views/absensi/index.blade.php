@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Absensi Harian</h3>
    <a href="{{ url('/') }}" class="btn btn-secondary">Dashboard</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        Input Absensi
    </div>

    <div class="card-body">
        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Siswa</label>
                <select name="siswa_id" class="form-control" required>
                    <option value="">-- Pilih Siswa --</option>

                    @foreach($siswas as $siswa)
                        <option value="{{ $siswa->id }}">
                            {{ $siswa->nama }} - {{ $siswa->kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Alpa">Alpa</option>
                </select>
            </div>

            <button class="btn btn-success">Simpan Absensi</button>
        </form>
    </div>
</div>
<div class="card shadow-sm mb-3">
    <div class="card-body">

        <form method="GET" action="{{ route('absensi.index') }}">

            <div class="row">

                <div class="col-md-4">
                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ request('tanggal') }}"
                    >
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary">
                        Filter
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Data Absensi
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @foreach($absensis as $absensi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $absensi->siswa->nama }}</td>
                <td>{{ $absensi->siswa->kelas }}</td>
                <td>{{ $absensi->tanggal }}</td>
                <td>
                    @if($absensi->status == 'Hadir')
                        <span class="badge bg-success">Hadir</span>
                    @elseif($absensi->status == 'Izin')
                        <span class="badge bg-info">Izin</span>
                    @elseif($absensi->status == 'Sakit')
                        <span class="badge bg-warning">Sakit</span>
                    @else
                        <span class="badge bg-danger">Alpa</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('absensi.edit', $absensi->id) }}"
                    class="btn btn-warning btn-sm">
                    Edit
                    </a>

                    <form action="{{ route('absensi.destroy', $absensi->id) }}"
                    method="POST"
                    class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Yakin hapus absensi?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection