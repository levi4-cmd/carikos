
<section>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Nama Lengkap</label>
            <input
                id="name"
                name="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            >

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold text-dark">Alamat Email</label>
            <input
                id="email"
                name="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            >

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning text-white fw-semibold px-4">
            <i class="bi bi-save me-1"></i> Simpan Perubahan
        </button>

        @if (session('status') === 'profile-updated')
            <span class="text-success small fw-semibold ms-2">
                <i class="bi bi-check-circle"></i> Profil berhasil diperbarui.
            </span>
        @endif
    </form>
</section>
