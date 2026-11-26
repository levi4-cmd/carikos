
@extends('layouts.main')

@section('title', 'Tambah Kos - CariKos')

@section('content')

<style>
    .create-hero {
        background: linear-gradient(135deg, var(--kp-navy), var(--kp-primary));
        color: white;
        padding: 42px 0 75px;
    }

    .create-card {
        background: white;
        border: 1px solid #e1e8f1;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(18, 48, 90, .06);
        margin-top: -45px;
        position: relative;
    }

    .form-label {
        font-weight: 700;
        color: var(--kp-navy);
        font-size: .9rem;
    }

    .form-control, .form-select {
        border: 1px solid #dce4ee;
        border-radius: 10px;
        padding: 11px 13px;
        font-size: .9rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--kp-primary);
        box-shadow: 0 0 0 .2rem rgba(59, 130, 246, .12);
    }

    .section-title {
        color: var(--kp-navy);
        font-weight: 800;
        font-size: 1.05rem;
        border-bottom: 1px solid #e8edf4;
        padding-bottom: 12px;
        margin-bottom: 22px;
    }

    .help-text {
        font-size: .78rem;
        color: var(--kp-muted);
        margin-top: 6px;
    }

    .required {
        color: #dc3545;
    }
</style>

<section class="create-hero">
    <div class="container">
        <a href="{{ route('dashboard') }}"
           class="text-white text-decoration-none small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>

        <h2 class="fw-bold mt-3 mb-2">Tambah Informasi Kos</h2>
        <p class="mb-0 text-white-50">
            Masukkan informasi kos agar calon penghuni dapat menemukannya.
        </p>
    </div>
</section>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="create-card">

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <strong>Data belum bisa disimpan.</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

<form action="{{ route('pemilik.kos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <h5 class="section-title">
                        <i class="bi bi-house-door me-2"></i>
                        Informasi Kos
                    </h5>

                    <div class="mb-3">
                        <label class="form-label">
                            Nama Kos <span class="required">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               placeholder="Contoh: Kos Melati"
                               required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Tipe Kos <span class="required">*</span>
                            </label>
                            <select name="type" class="form-select" required>
                                <option value="">Pilih tipe kos</option>
                                @foreach (['Putri', 'Putra', 'Campur', 'Kontrakan'] as $type)
                                    <option value="{{ $type }}"
                                        @selected(old('type') == $type)>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Mulai (Rp)</label>
                            <input type="number"
                                   name="harga_mulai"
                                   class="form-control"
                                   value="{{ old('harga_mulai') }}"
                                   min="0"
                                   placeholder="Contoh: 500000">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone') }}"
                               placeholder="Contoh: 081234567890">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Alamat Lengkap <span class="required">*</span>
                        </label>
                        <textarea name="address"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Masukkan alamat lengkap kos"
                                  required>{{ old('address') }}</textarea>
                    </div>

                    <h5 class="section-title">
                        <i class="bi bi-geo-alt me-2"></i>
                        Lokasi Kos
                    </h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="number"
                                   step="any"
                                   name="lat"
                                   class="form-control"
                                   value="{{ old('lat') }}"
                                   placeholder="Contoh: -5.367">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="number"
                                   step="any"
                                   name="lng"
                                   class="form-control"
                                   value="{{ old('lng') }}"
                                   placeholder="Contoh: 105.239">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Link Google Maps</label>
                        <input type="url"
                               name="maps_url"
                               class="form-control"
                               value="{{ old('maps_url') }}"
                               placeholder="https://maps.google.com/...">
                    </div>

                    <h5 class="section-title">
                        <i class="bi bi-stars me-2"></i>
                        Fasilitas dan Keterangan
                    </h5>

                    <div class="mb-3">
                        <label class="form-label">Fasilitas Kos</label>
                        <textarea name="facilities"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Contoh: WiFi, Parkir, AC, Kamar Mandi Dalam">{{ old('facilities') }}</textarea>
                        <div class="help-text">
                            Pisahkan setiap fasilitas menggunakan tanda koma.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Catatan Tambahan</label>
                        <textarea name="notes"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Tambahkan informasi lain mengenai kos...">{{ old('notes') }}</textarea>
                    </div>


<h5 class="section-title">
    <i class="bi bi-images me-2"></i>
    Foto Kos
</h5>

<div class="mb-4">
    <label class="form-label">Upload Foto Kos</label>

    <input type="file"
           name="photos[]"
           class="form-control"
           accept="image/jpeg,image/png,image/webp"
           multiple>

    <div class="help-text">
        Pilih beberapa foto sekaligus. Format JPG, PNG, atau WEBP.
        Maksimal 2 MB untuk setiap foto.
    </div>
</div>
                    
                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">
                        <a href="{{ route('dashboard') }}"
                           class="btn btn-light border rounded-3 px-4 py-2">
                            Batal
                        </a>

                        <button type="submit"
                                class="btn kp-btn-main px-4 py-2">
                            <i class="bi bi-save me-1"></i>
                            Simpan Informasi Kos
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
