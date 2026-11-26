
<section>
    <p class="text-secondary small mb-3">
        Jika akun dihapus, seluruh informasi dan data akun Anda akan dihapus secara permanen.
        Pastikan Anda benar-benar ingin melanjutkan tindakan ini.
    </p>

    <form
        method="POST"
        action="{{ route('profile.destroy') }}"
        onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen? Tindakan ini tidak dapat dibatalkan.');"
    >
        @csrf
        @method('DELETE')

        <div class="mb-3">
            <label for="delete_password" class="form-label fw-semibold text-dark">
                Masukkan Kata Sandi untuk Konfirmasi
            </label>
            <input
                id="delete_password"
                name="password"
                type="password"
                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                placeholder="Masukkan kata sandi akun Anda"
                autocomplete="current-password"
                required
            >

            @error('password', 'userDeletion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger fw-semibold px-4">
            <i class="bi bi-trash3 me-1"></i> Hapus Akun Saya
        </button>
    </form>
</section>
