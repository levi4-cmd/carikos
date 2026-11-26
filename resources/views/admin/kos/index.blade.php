
@extends('layouts.main')

@section('title', 'Kelola Data Kos - CariKos')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <span class="badge bg-primary-subtle text-primary mb-2">
                Panel Admin
            </span>
            <h2 class="fw-bold mb-1">Kelola Data Kos</h2>
            <p class="text-muted mb-0">
                Daftar seluruh kos yang terdaftar di CariKos.
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="p-4 border-bottom">
                <h5 class="fw-bold mb-1">Daftar Kos</h5>
                <small class="text-muted">
                    Total data: {{ $kos->total() }} kos
                </small>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">No.</th>
                            <th>Nama Kos</th>
                            <th>Jenis</th>
                            <th>Harga Mulai</th>
                            <th>Pemilik</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kos as $item)
                            <tr>
                                <td class="px-4">
                                    {{ $kos->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>{{ $item->name }}</strong>
                                </td>

                                <td>
                                    {{ $item->type ?? '-' }}
                                </td>

                                <td>
                                    @if ($item->harga_mulai)
                                        Rp{{ number_format($item->harga_mulai, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    {{ $item->owner->name ?? 'Belum terhubung' }}
                                </td>

                                <td>
                                    {{ $item->address ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    Belum ada data kos.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4">
                {{ $kos->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
