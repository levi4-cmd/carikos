
<section>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="current_password" class="form-label fw-semibold text-dark">
                Kata Sandi Saat Ini
            </label>
            <input
                id="current_password"
                name="current_password"
                type="password"
                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                autocomplete="current-password"
                required
            >

            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold text-dark">
                Kata Sandi Baru
            </label>
            <input
                id="password"
                name="password"
                type="password"
                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password"
                required
            >

            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold text-dark">
                Konfirmasi Kata Sandi Baru
            </label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-control"
                autocomplete="new-password"
                required
            >
        </div>

        <button type="submit" class="btn btn-warning text-white fw-semibold px-4">
            <i class="bi bi-shield-check me-1"></i> Perbarui Kata Sandi
        </button>

        @if (session('status') === 'password-updated')
            <span class="text-success small fw-semibold ms-2">
                <i class="bi bi-check-circle"></i> Kata sandi berhasil diperbarui.
            </span>
        @endif
    </form>
</section>
