<!DOCTYPE html>
<html>
<head>
    <title>Rekap Absensi PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #eee;
        }

        h2, p {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Laporan Rekap Absensi Siswa</h2>
<p>Bulan: {{ $bulan }} | Tahun: {{ $tahun }}</p>

<table>
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

</body>
</html>