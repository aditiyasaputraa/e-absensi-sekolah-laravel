@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Siswa</h3>
    <a href="{{ route('siswa.create') }}" class="btn btn-primary">Tambah Siswa</a>
</div>

<form method="GET" action="{{ route('siswa.index') }}" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Cari nama, NIS, atau kelas..."
                value="{{ request('search') }}"
            >
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">Cari</button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>

            @foreach($siswas as $siswa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->kelas }}</td>
                <td>
                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        <a href="{{ url('/') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection