<x-guest-layout>

    <div class="mb-3 text-center">
        <h5 class="fw-semibold">Masuk ke Dashboard</h5>
        <p class="text-muted" style="font-size: 14px;">
            Gunakan akun admin untuk mengelola data absensi
        </p>
    </div>

    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control"
                placeholder="Masukkan email"
                required
                autofocus
            >

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Masukkan password"
                required
            >

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">
                Ingat saya
            </label>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Masuk
        </button>
    </form>

</x-guest-layout>