<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Absensi Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<div class="container">
    <div class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-md-5">

            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary mb-1">E-Absensi Sekolah</h3>
                        <p class="text-muted mb-0">
                            Sistem Informasi Absensi Siswa
                        </p>
                    </div>

                    {{ $slot }}

                </div>
            </div>

            <p class="text-center text-muted mt-3" style="font-size: 13px;">
                © {{ date('Y') }} Sistem Absensi Siswa
            </p>

        </div>
    </div>
</div>

</body>
</html>