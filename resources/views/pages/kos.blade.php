
@extends('layouts.app')

@section('title', 'Cari Kos - CariKos')

@section('content')

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 text-primary" href="/">
            CariKos<span class="text-warning">.</span>
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mx-auto gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fw-bold text-primary" href="/kos">Cari Kos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#tentang">Tentang Kami</a>
                </li>
            </ul>

            <div class="d-flex gap-2">
                <a href="#" class="btn btn-outline-primary px-4">Masuk</a>
                <a href="#" class="btn btn-primary px-4">Daftar</a>
            </div>
        </div>
    </div>
</nav>

<!-- HEADER -->
<section class="kos-header py-5">
    <div class="container">
        <h1 class="fw-bold text-white">Temukan Kos yang Tepat</h1>
        <p class="text-white-50">
            Cari hunian nyaman sesuai lokasi, harga, dan kebutuhanmu.
        </p>
    </div>
</section>

<!-- PENCARIAN DAN DAFTAR KOS -->
<section class="container py-5">

    <div class="row g-4">

        <!-- FILTER -->
        <div class="col-lg-3">
            <div class="filter-card shadow-sm">
                <h5 class="fw-bold mb-4">Filter Pencarian</h5>

                <form id="filterForm">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama atau Lokasi</label>
                        <input type="text" id="keyword"
                            class="form-control"
                            placeholder="Contoh: Rajabasa">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Kos</label>
                        <select id="jenis" class="form-select">
                            <option value="">Semua jenis</option>
                            <option value="Putra">Putra</option>
                            <option value="Putri">Putri</option>
                            <option value="Campur">Campur</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga Maksimal</label>
                        <select id="harga" class="form-select">
                            <option value="">Semua harga</option>
                            <option value="500000">Rp500.000</option>
                            <option value="750000">Rp750.000</option>
                            <option value="1000000">Rp1.000.000</option>
                            <option value="1500000">Rp1.500.000</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Terapkan Filter
                    </button>

                    <button type="reset" class="btn btn-outline-secondary w-100 mt-2">
                        Reset Filter
                    </button>

                </form>
            </div>
        </div>

        <!-- DAFTAR KOS -->
        <div class="col-lg-9">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-1">Daftar Kos</h4>
                    <p class="text-secondary mb-0">
                        <span id="jumlahKos">6</span> pilihan kos tersedia
                    </p>
                </div>
            </div>

            <div class="row g-4" id="daftarKos">

                <!-- KOS 1 -->
                <div class="col-md-6 col-xl-4 kos-item"
                    data-name="Kos Melati"
                    data-location="Bandar Lampung"
                    data-type="Putra"
                    data-price="750000">

                    <div class="card kos-list-card h-100">
                        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800"
                            class="kos-list-image" alt="Kos Melati">

                        <div class="card-body">
                            <span class="badge bg-primary">Putra</span>
                            <h5 class="fw-bold mt-2">Kos Melati</h5>
                            <p class="text-secondary small">Bandar Lampung</p>
                            <p class="text-secondary small">WiFi · Kamar mandi dalam</p>
                            <p class="kos-price">Rp750.000 <small>/ bulan</small></p>
                            <a href="#" class="btn btn-outline-primary w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KOS 2 -->
                <div class="col-md-6 col-xl-4 kos-item"
                    data-name="Kos Sejahtera"
                    data-location="Kedaton Bandar Lampung"
                    data-type="Putri"
                    data-price="900000">

                    <div class="card kos-list-card h-100">
                        <img src="https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=800"
                            class="kos-list-image" alt="Kos Sejahtera">

                        <div class="card-body">
                            <span class="badge bg-danger">Putri</span>
                            <h5 class="fw-bold mt-2">Kos Sejahtera</h5>
                            <p class="text-secondary small">Kedaton, Bandar Lampung</p>
                            <p class="text-secondary small">AC · WiFi · Parkir</p>
                            <p class="kos-price">Rp900.000 <small>/ bulan</small></p>
                            <a href="#" class="btn btn-outline-primary w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KOS 3 -->
                <div class="col-md-6 col-xl-4 kos-item"
                    data-name="Kos Harmoni"
                    data-location="Rajabasa Bandar Lampung"
                    data-type="Campur"
                    data-price="600000">

                    <div class="card kos-list-card h-100">
                        <img src="https://images.unsplash.com/photo-1600607687520-8e7a4e3f4e8d?w=800"
                            class="kos-list-image" alt="Kos Harmoni">

                        <div class="card-body">
                            <span class="badge bg-success">Campur</span>
                            <h5 class="fw-bold mt-2">Kos Harmoni</h5>
                            <p class="text-secondary small">Rajabasa, Bandar Lampung</p>
                            <p class="text-secondary small">WiFi · Dapur bersama</p>
                            <p class="kos-price">Rp600.000 <small>/ bulan</small></p>
                            <a href="#" class="btn btn-outline-primary w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KOS 4 -->
                <div class="col-md-6 col-xl-4 kos-item"
                    data-name="Kos Anggrek"
                    data-location="Rajabasa Bandar Lampung"
                    data-type="Putri"
                    data-price="1200000">

                    <div class="card kos-list-card h-100">
                        <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800"
                            class="kos-list-image" alt="Kos Anggrek">

                        <div class="card-body">
                            <span class="badge bg-danger">Putri</span>
                            <h5 class="fw-bold mt-2">Kos Anggrek</h5>
                            <p class="text-secondary small">Rajabasa, Bandar Lampung</p>
                            <p class="text-secondary small">AC · WiFi · Lemari</p>
                            <p class="kos-price">Rp1.200.000 <small>/ bulan</small></p>
                            <a href="#" class="btn btn-outline-primary w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KOS 5 -->
                <div class="col-md-6 col-xl-4 kos-item"
                    data-name="Kos Mawar"
                    data-location="Sukarame Bandar Lampung"
                    data-type="Putra"
                    data-price="500000">

                    <div class="card kos-list-card h-100">
                        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800"
                            class="kos-list-image" alt="Kos Mawar">

                        <div class="card-body">
                            <span class="badge bg-primary">Putra</span>
                            <h5 class="fw-bold mt-2">Kos Mawar</h5>
                            <p class="text-secondary small">Sukarame, Bandar Lampung</p>
                            <p class="text-secondary small">Parkir · Kamar mandi luar</p>
                            <p class="kos-price">Rp500.000 <small>/ bulan</small></p>
                            <a href="#" class="btn btn-outline-primary w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KOS 6 -->
                <div class="col-md-6 col-xl-4 kos-item"
                    data-name="Kos Cendana"
                    data-location="Kedaton Bandar Lampung"
                    data-type="Campur"
                    data-price="1500000">

                    <div class="card kos-list-card h-100">
                        <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800"
                            class="kos-list-image" alt="Kos Cendana">

                        <div class="card-body">
                            <span class="badge bg-success">Campur</span>
                            <h5 class="fw-bold mt-2">Kos Cendana</h5>
                            <p class="text-secondary small">Kedaton, Bandar Lampung</p>
                            <p class="text-secondary small">AC · WiFi · Parkir</p>
                            <p class="kos-price">Rp1.500.000 <small>/ bulan</small></p>
                            <a href="#" class="btn btn-outline-primary w-100">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div id="kosKosong" class="text-center py-5 d-none">
                <h5 class="fw-bold">Kos tidak ditemukan</h5>
                <p class="text-secondary">
                    Coba ubah kata kunci atau filter pencarianmu.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer-section py-4">
    <div class="container text-center text-white">
        <h4 class="fw-bold">CariKos.</h4>
        <p class="mb-2">Temukan hunian nyaman dengan lebih mudah.</p>
        <small>© 2026 CariKos. All Rights Reserved.</small>
    </div>
</footer>

@endsection

@push('styles')
<style>
    .kos-header {
        background: linear-gradient(120deg, #102c54, #245b91);
    }

    .filter-card {
        background: white;
        border-radius: 14px;
        padding: 24px;
        position: sticky;
        top: 20px;
    }

    .kos-list-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(0,0,0,0.06);
        transition: 0.2s;
    }

    .kos-list-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.10);
    }

    .kos-list-image {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }

    .kos-price {
        color: #1d65a6;
        font-weight: bold;
        font-size: 18px;
    }

    .kos-price small {
        color: #6c757d;
        font-size: 12px;
        font-weight: normal;
    }
</style>
@endpush

@push('scripts')
<script>
    const filterForm = document.getElementById('filterForm');
    const kosItems = document.querySelectorAll('.kos-item');

    function filterKos() {
        const keyword = document.getElementById('keyword').value
            .toLowerCase().trim();

        const jenis = document.getElementById('jenis').value;
        const harga = document.getElementById('harga').value;

        let jumlah = 0;

        kosItems.forEach(function(kos) {
            const nama = kos.dataset.name.toLowerCase();
            const lokasi = kos.dataset.location.toLowerCase();
            const tipe = kos.dataset.type;
            const hargaKos = Number(kos.dataset.price);

            const cocokKeyword =
                nama.includes(keyword) || lokasi.includes(keyword);

            const cocokJenis = !jenis || tipe === jenis;
            const cocokHarga = !harga || hargaKos <= Number(harga);

            if (cocokKeyword && cocokJenis && cocokHarga) {
                kos.classList.remove('d-none');
                jumlah++;
            } else {
                kos.classList.add('d-none');
            }
        });

        document.getElementById('jumlahKos').textContent = jumlah;

        document.getElementById('kosKosong')
            .classList.toggle('d-none', jumlah !== 0);
    }

    filterForm.addEventListener('submit', function(event) {
        event.preventDefault();
        filterKos();
    });

    filterForm.addEventListener('reset', function() {
        setTimeout(filterKos, 0);
    });
</script>
@endpush
