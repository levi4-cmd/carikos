
@extends('layouts.main')

@section('title', 'Kelola Pengguna - CariKos')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <span class="badge bg-primary-subtle text-primary mb-2">
                Panel Admin
            </span>
            <h2 class="fw-bold mb-1">Kelola Pengguna</h2>
            <p class="text-muted mb-0">
                Daftar seluruh akun yang terdaftar di CariKos.
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="p-4 border-bottom">
                <h5 class="fw-bold mb-1">Daftar Pengguna</h5>
                <small class="text-muted">
                    Total pengguna: {{ $users->total() }} akun
                </small>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="px-4">No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Tanggal Terdaftar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="px-4">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>{{ $user->name }}</strong>
                                </td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    @if ($user->role === 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @elseif ($user->role === 'pemilik')
                                        <span class="badge bg-primary">Pemilik</span>
                                    @else
                                        <span class="badge bg-success">Pencari</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $user->created_at?->format('d M Y') ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    Belum ada pengguna terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="p-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
