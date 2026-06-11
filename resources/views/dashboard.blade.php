@extends('layouts.admin')

@section('content')

<h3 class="mb-4">Dashboard Absensi Siswa</h3>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm bg-primary text-white">
            <div class="card-body">
                <h5>Total Siswa</h5>
                <h2>{{ $totalSiswa }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm bg-success text-white">
            <div class="card-body">
                <h5>Hadir</h5>
                <h2>{{ $hadir }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm bg-info text-white">
            <div class="card-body">
                <h5>Izin</h5>
                <h2>{{ $izin }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm bg-warning text-white">
            <div class="card-body">
                <h5>Sakit</h5>
                <h2>{{ $sakit }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm bg-danger text-white">
            <div class="card-body">
                <h5>Alpa</h5>
                <h2>{{ $alpa }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white">
        Grafik Absensi Hari Ini
    </div>

    <div class="card-body">
        <canvas id="grafikAbsensi" height="100"></canvas>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Data Siswa</h5>
                <p>Kelola data siswa seperti NIS, nama, dan kelas.</p>
                <a href="{{ route('siswa.index') }}" class="btn btn-primary">Buka Data Siswa</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Absensi Harian</h5>
                <p>Input dan lihat data kehadiran siswa.</p>
                <a href="{{ route('absensi.index') }}" class="btn btn-success">Buka Absensi</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('grafikAbsensi');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Hadir', 'Izin', 'Sakit', 'Alpa'],
            datasets: [{
                label: 'Jumlah Siswa',
                data: [
                    {{ $hadir }},
                    {{ $izin }},
                    {{ $sakit }},
                    {{ $alpa }}
                ]
            }]
        }
    });
</script>

@endsection