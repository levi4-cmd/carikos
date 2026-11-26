
@extends('layouts.main')

@section('title', 'Dashboard Admin - CariKos')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <span class="badge bg-primary-subtle text-primary mb-2">
            Dashboard Admin
        </span>

        <h2 class="fw-bold">Dashboard Admin</h2>

        <p class="text-muted">
            Selamat datang, {{ Auth::user()->name }}.
            Kelola data kos dan pengguna CariKos melalui halaman ini.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold">Kelola Data Kos</h5>
                    <p class="text-muted">
                        Lihat dan kelola seluruh data kos yang terdaftar.
                    </p>
                    <a href="{{ route('admin.kos.index') }}" class="btn btn-primary">
                        Kelola Data Kos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold">Kelola Pengguna</h5>
                    <p class="text-muted">
                        Lihat dan kelola akun pencari kos serta pemilik kos.
                    </p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
                        Kelola Pengguna
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
