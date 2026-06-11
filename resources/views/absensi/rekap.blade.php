@extends('layouts.admin')

@section('content')

<h3>Rekap Absensi Bulanan</h3>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('absensi.rekap') }}" class="row">
            <div class="col-md-3">
                <label>Bulan</label>
                <select name="bulan" class="form-control">
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-md-3">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control" value="{{ $tahun }}">
            </div>

            <div class="col-md-3 mt-4">
                <button class="btn btn-primary">Tampilkan</button>
                <a href="{{ route('absensi.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="btn btn-danger">
                Export PDF
                    </a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Data Rekap Absensi
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alpa</th>
            </tr>

            @foreach($siswas as $siswa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->kelas }}</td>
                <td>{{ $siswa->absensis->where('status', 'Hadir')->count() }}</td>
                <td>{{ $siswa->absensis->where('status', 'Izin')->count() }}</td>
                <td>{{ $siswa->absensis->where('status', 'Sakit')->count() }}</td>
                <td>{{ $siswa->absensis->where('status', 'Alpa')->count() }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection