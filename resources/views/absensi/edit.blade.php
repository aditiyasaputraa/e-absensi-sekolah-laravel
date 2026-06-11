@extends('layouts.admin')

@section('content')

<h3>Edit Absensi</h3>

<div class="card">
    <div class="card-body">

        <form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Siswa</label>

                <select name="siswa_id" class="form-control">

                    @foreach($siswas as $siswa)

                    <option
                        value="{{ $siswa->id }}"
                        {{ $absensi->siswa_id == $siswa->id ? 'selected' : '' }}
                    >
                        {{ $siswa->nama }}
                    </option>

                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>

                <input
                    type="date"
                    name="tanggal"
                    value="{{ $absensi->tanggal }}"
                    class="form-control"
                >
            </div>

            <div class="mb-3">
                <label>Status</label>

                <select name="status" class="form-control">

                    <option value="Hadir" {{ $absensi->status == 'Hadir' ? 'selected' : '' }}>
                        Hadir
                    </option>

                    <option value="Izin" {{ $absensi->status == 'Izin' ? 'selected' : '' }}>
                        Izin
                    </option>

                    <option value="Sakit" {{ $absensi->status == 'Sakit' ? 'selected' : '' }}>
                        Sakit
                    </option>

                    <option value="Alpa" {{ $absensi->status == 'Alpa' ? 'selected' : '' }}>
                        Alpa
                    </option>

                </select>
            </div>

            <button class="btn btn-success">
                Update
            </button>

            <a href="{{ route('absensi.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection