
@extends('layouts.main')

@section('title', 'Dashboard Pemilik Kos - CariKos')

@section('content')

<div class="container py-5">

    <div class="mb-4">
        <span class="badge bg-primary-subtle text-primary mb-2">
            Dashboard Pemilik
        </span>

        <h2 class="fw-bold">Dashboard Pemilik Kos</h2>

        <p class="text-muted">
            Selamat datang, {{ Auth::user()->name }}!
            Kelola informasi kos Anda melalui halaman ini.
        </p>
    </div>

    <div class="row g-4">

        {{-- Kelola Kos --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">

                <div class="mb-3 text-primary">
                    <i class="bi bi-house-add fs-1"></i>
                </div>

                <h5 class="fw-bold">Kelola Kos</h5>

                <p class="text-muted">
                    Tambahkan informasi kos baru dan kelola kos milik Anda.
                </p>

                <div class="d-grid gap-2 mt-auto">

                    <a href="{{ route('pemilik.kos.index') }}"
                       class="btn kp-btn-main">
                        <i class="bi bi-list-ul me-1"></i>
                        Kelola Kos Saya
                    </a>

                    <a href="{{ route('pemilik.kos.create') }}"
                       class="btn btn-outline-primary rounded-3">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Kos
                    </a>

                </div>
            </div>
        </div>

        {{-- Data Kamar --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">

                <div class="mb-3 text-primary">
                    <i class="bi bi-door-open fs-1"></i>
                </div>

                <h5 class="fw-bold">Data Kamar</h5>

                <p class="text-muted">
                    Pantau harga dan ketersediaan kamar kos.
                </p>

                <span class="text-muted small mt-auto">
                    Fitur dalam pengembangan
                </span>

            </div>
        </div>

        {{-- Profil Pemilik --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">

                <div class="mb-3 text-primary">
                    <i class="bi bi-person-circle fs-1"></i>
                </div>

                <h5 class="fw-bold">Profil Pemilik</h5>

                <p class="text-muted">
                    Perbarui informasi akun pemilik kos Anda.
                </p>

                <a href="{{ route('profile.edit') }}"
                   class="btn btn-outline-primary rounded-3 mt-auto">
                    <i class="bi bi-person me-1"></i>
                    Lihat Profil
                </a>

            </div>
        </div>

    </div>

</div>

@endsection
