
@extends('layouts.main')

@section('title', 'Kos Saya - CariKos')

@section('content')

<div class="container py-5">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <a href="{{ route('dashboard') }}"
               class="text-decoration-none small text-muted">
                <i class="bi bi-arrow-left me-1"></i> Dashboard
            </a>

            <h2 class="fw-bold mt-2 mb-1">Kos Milik Saya</h2>
            <p class="text-muted mb-0">
                Kelola informasi kos yang sudah Anda tambahkan.
            </p>
        </div>

        <a href="{{ route('pemilik.kos.create') }}"
           class="btn kp-btn-main px-4">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Kos
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success rounded-3">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($kos->isEmpty())
        <div class="bg-white rounded-4 shadow-sm text-center p-5">
            <i class="bi bi-house-x text-muted" style="font-size: 3rem;"></i>

            <h5 class="fw-bold mt-3">Belum Ada Kos</h5>

            <p class="text-muted">
                Anda belum menambahkan informasi kos.
            </p>

            <a href="{{ route('pemilik.kos.create') }}"
               class="btn kp-btn-main px-4">
                Tambahkan Kos Pertama
            </a>
        </div>
    @else
        <div class="row g-4">

            @foreach ($kos as $item)
                <div class="col-md-6 col-lg-4">

                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                        <div class="p-4 bg-light">
                            <span class="badge bg-primary">
                                {{ $item->type }}
                            </span>

                            <i class="bi bi-house-door text-primary float-end fs-3"></i>

                            <h5 class="fw-bold mt-3 mb-2">
                                {{ $item->name }}
                            </h5>

                            <p class="text-muted small mb-2">
                                <i class="bi bi-geo-alt me-1"></i>
                                {{ $item->address }}
                            </p>

                            <h6 class="fw-bold text-primary mb-0">
                                @if ($item->harga_mulai)
                                    Rp{{ number_format($item->harga_mulai, 0, ',', '.') }}
                                    <small class="text-muted fw-normal">/ mulai</small>
                                @else
                                    Harga belum diisi
                                @endif
                            </h6>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="small text-muted mb-3">
                                <i class="bi bi-stars me-1"></i>
                                {{ $item->facilities ?: 'Fasilitas belum diisi' }}
                            </div>

                            <div class="d-flex gap-2 mt-auto">

                                <a href="{{ route('pemilik.kos.edit', $item->id) }}"
                                   class="btn btn-outline-primary btn-sm flex-fill">
                                    <i class="bi bi-pencil-square me-1"></i>
                                    Edit
                                </a>

                                <form action="{{ route('pemilik.kos.destroy', $item->id) }}"
                                      method="POST"
                                      class="flex-fill"
                                      onsubmit="return confirm('Yakin ingin menghapus kos ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-outline-danger btn-sm w-100">
                                        <i class="bi bi-trash me-1"></i>
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>
    @endif

</div>

@endsection
