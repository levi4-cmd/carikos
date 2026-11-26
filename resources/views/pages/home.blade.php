
@extends('layouts.main')

@section('title', 'Beranda - CariKos')

@section('content')

<style>
    .home-page {
        --kos-primary: var(--kp-primary-dark);
        --kos-primary-dark: var(--kp-primary-hover);
        --kos-dark: var(--kp-navy);
        --kos-muted: var(--kp-muted);
        --kos-light: var(--kp-primary-light);
        color: var(--kos-dark);
        background: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .home-page .btn-kos {
        background: var(--kos-primary);
        color: white;
        border: 1px solid var(--kos-primary);
        border-radius: 10px;
        font-weight: 600;
        padding: 11px 22px;
        transition: .25s;
    }

    .home-page .btn-kos:hover {
        background: var(--kos-primary-dark);
        border-color: var(--kos-primary-dark);
        color: white;
        transform: translateY(-2px);
    }

    .home-page .btn-outline-kos {
        color: var(--kos-primary);
        border: 1px solid var(--kos-primary);
        border-radius: 10px;
        font-weight: 600;
        padding: 10px 22px;
    }

    .home-page .btn-outline-kos:hover {
        background: var(--kos-primary);
        color: white;
    }

    /* HERO */
    .home-page .hero-section {
        position: relative;
        overflow: hidden;
        padding: 95px 0 105px;
        background:
            radial-gradient(circle at 85% 15%, rgba(59,130,246,.18), transparent 28%),
            linear-gradient(135deg, var(--kp-navy) 0%, var(--kp-navy-2) 100%);
    }

    .home-page .hero-section::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,.08);
        top: -210px;
        right: -100px;
    }

    .home-page .hero-section h1 {
        font-size: clamp(2.4rem, 5vw, 3.8rem);
        line-height: 1.2;
        letter-spacing: -2px;
    }

    .home-page .hero-highlight {
        color: #93C5FD;
    }

    .home-page .hero-image {
        width: 100%;
        height: 390px;
        object-fit: cover;
        border-radius: 24px;
        box-shadow: 0 25px 60px rgba(0,0,0,.25);
        border: 5px solid rgba(255,255,255,.15);
    }

    .home-page .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.18);
        color: #BFDBFE;
        border-radius: 50px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 600;
    }

    .home-page .search-box {
        background: white;
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 18px 45px rgba(0,0,0,.18);
    }

    .home-page .search-box .form-control,
    .home-page .search-box .form-select {
        min-height: 48px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
    }

    .home-page .search-box .form-control:focus,
    .home-page .search-box .form-select:focus {
        border-color: var(--kos-primary);
        box-shadow: 0 0 0 3px rgba(59,130,246,.12);
    }

    /* SECTION */
    .home-page .section-label {
        color: var(--kos-primary);
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 1.5px;
    }

    .home-page .feature-section {
        padding: 75px 0;
        background: #fff;
    }

    .home-page .feature-card {
        height: 100%;
        padding: 30px 24px;
        border: 1px solid #edf0f4;
        border-radius: 18px;
        transition: .25s;
        background: white;
    }

    .home-page .feature-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 15px 35px rgba(15,23,42,.08);
        border-color: #BFDBFE;
    }

    .home-page .feature-icon {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: var(--kos-light);
        color: var(--kos-primary);
        font-size: 25px;
        margin-bottom: 20px;
    }

    /* REKOMENDASI */
    .home-page .recommendation-section {
        padding: 75px 0;
        background: #f8fafc;
    }

    .home-page .kos-card {
        border: 1px solid #edf0f4;
        border-radius: 18px;
        overflow: hidden;
        transition: .3s;
    }

    .home-page .kos-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 18px 35px rgba(15,23,42,.1) !important;
    }

    .home-page .kos-image {
        width: 100%;
        height: 225px;
        object-fit: cover;
        transition: .4s;
    }

    .home-page .kos-card:hover .kos-image {
        transform: scale(1.04);
    }

    .home-page .kos-image-wrap {
        overflow: hidden;
        position: relative;
        background: #e2e8f0;
    }

    .home-page .kos-card .card-body {
        padding: 22px;
    }

    .home-page .price {
        color: var(--kos-primary);
        font-size: 20px;
        font-weight: 800;
    }

    /* TENTANG */
    .home-page .about-section {
        padding: 85px 0;
        background: white;
    }

    .home-page .about-box {
        background: var(--kos-light);
        padding: 55px 30px;
        border-radius: 24px;
    }

    @media (max-width: 991px) {
        .home-page .hero-section {
            padding: 65px 0;
        }

        .home-page .hero-image {
            height: 320px;
        }
    }

    @media (max-width: 576px) {
        .home-page .hero-section h1 {
            font-size: 2.35rem;
        }

        .home-page .hero-image {
            height: 250px;
        }

        .home-page .search-box {
            padding: 17px;
        }
    }
</style>

<div class="home-page">

    <!-- HERO -->
    <section class="hero-section">
        <div class="container position-relative">
            <div class="row align-items-center g-5">

                <div class="col-lg-7">

                    <span class="hero-badge mb-4">
                        <i class="bi bi-house-heart-fill"></i>
                        Temukan Hunian Terbaikmu
                    </span>

                    <h1 class="fw-bold text-white mt-3">
                        Temukan Kos Nyaman,
                        <span class="hero-highlight">Mulai Cerita Baru.</span>
                    </h1>

                    <p class="text-white-50 fs-5 mt-4 mb-4">
                        Bingung mencari tempat tinggal?
                        CariKos membantu kamu menemukan hunian yang nyaman,
                        sesuai kebutuhan, dan sesuai anggaran.
                    </p>

                    <!-- FORM PENCARIAN -->
                    <div class="search-box mt-4">
                        <form action="{{ route('kos.index') }}" method="GET" id="homeSearchForm">

                            <input type="hidden" name="min_harga" id="minHarga">
                            <input type="hidden" name="max_harga" id="maxHarga">

                            <div class="row g-3">

                                <div class="col-md-5">
                                    <label class="form-label fw-semibold small">
                                        <i class="bi bi-geo-alt text-warning"></i>
                                        Lokasi Kos
                                    </label>

                                    <input type="text"
                                        name="lokasi"
                                        class="form-control"
                                        placeholder="Cari daerah atau lokasi...">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold small">
                                        <i class="bi bi-wallet2 text-warning"></i>
                                        Kisaran Harga
                                    </label>

                                    <select id="rentRange" class="form-select">
                                        <option value="">Semua harga</option>
                                        <option value="under">Di bawah Rp500.000</option>
                                        <option value="middle">Rp500.000 - Rp1.000.000</option>
                                        <option value="above">Di atas Rp1.000.000</option>
                                    </select>
                                </div>

                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-kos w-100">
                                        <i class="bi bi-search me-1"></i>
                                        Cari Kos
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>

                    <div class="d-flex flex-wrap gap-4 mt-4 text-white-50 small">
                        <span><i class="bi bi-check-circle-fill text-warning me-1"></i> Pencarian mudah</span>
                        <span><i class="bi bi-check-circle-fill text-warning me-1"></i> Informasi lengkap</span>
                        <span><i class="bi bi-check-circle-fill text-warning me-1"></i> Pilihan beragam</span>
                    </div>

                </div>

                <div class="col-lg-5">
                    <img
                        src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=900&q=80"
                        onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=900&q=80';"
                        class="hero-image"
                        alt="Kamar kos sederhana">

                    <div class="d-flex align-items-center gap-3 bg-white rounded-4 p-3 shadow mt-3">
                        <div class="feature-icon mb-0">
                            <i class="bi bi-house-check"></i>
                        </div>

                        <div>
                            <h6 class="fw-bold mb-1">Cari Hunian Lebih Mudah</h6>
                            <small class="text-secondary">
                                Semua informasi kos dalam satu tempat.
                            </small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- KEUNGGULAN -->
    <section class="feature-section">
        <div class="container">

            <div class="text-center mb-5">
                <span class="section-label">KENAPA CARIKOS?</span>
                <h2 class="fw-bold mt-2">Mencari Kos Jadi Lebih Praktis</h2>
                <p class="text-secondary">
                    Kami membantu proses pencarian tempat tinggal menjadi lebih mudah.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-search"></i>
                        </div>

                        <h5 class="fw-bold">Pencarian Mudah</h5>
                        <p class="text-secondary mb-0">
                            Temukan kos berdasarkan lokasi, harga,
                            dan kebutuhan tempat tinggal.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-house-check"></i>
                        </div>

                        <h5 class="fw-bold">Informasi Lengkap</h5>
                        <p class="text-secondary mb-0">
                            Lihat informasi harga, fasilitas,
                            foto, dan ketersediaan kamar.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-star"></i>
                        </div>

                        <h5 class="fw-bold">Ulasan Pengguna</h5>
                        <p class="text-secondary mb-0">
                            Pertimbangkan rating dan ulasan
                            sebelum menentukan pilihan kos.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- REKOMENDASI KOS DARI DATABASE -->
    <section class="recommendation-section" id="rekomendasi">
        <div class="container">

            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-5">
                <div>
                    <span class="section-label">PILIHAN TEMPAT TINGGAL</span>
                    <h2 class="fw-bold mt-2 mb-2">Rekomendasi Kos</h2>
                    <p class="text-secondary mb-0">
                        Temukan tempat tinggal yang sesuai dengan kebutuhanmu.
                    </p>
                </div>

                <a href="{{ route('kos.index') }}" class="btn btn-outline-kos">
                    Lihat Semua Kos <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">

                @forelse ($top as $kos)
                    @php
                        $namaKos = data_get($kos, 'name')
                            ?? data_get($kos, 'nama')
                            ?? data_get($kos, 'title')
                            ?? 'Kos';

                        $hargaKos = data_get($kos, 'price')
                            ?? data_get($kos, 'price_per_month')
                            ?? data_get($kos, 'harga');

                        $tipeKos = data_get($kos, 'type') ?? 'Kos';
                        $alamatKos = data_get($kos, 'address') ?? 'Bandar Lampung';
                        $ratingKos = data_get($kos, 'rating');

                        // Foto ilustrasi kamar kos sederhana.
                        $gambarKos = [
                            'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=800&q=80',
                        ];

                        $gambarCadangan = 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=800&q=80';

                        $gambar = $gambarKos[$loop->index % count($gambarKos)];
                    @endphp

                    <div class="col-md-6 col-lg-4">
                        <div class="card kos-card h-100 shadow-sm">

                            <div class="kos-image-wrap">
                                <img
                                    src="{{ $gambar }}"
                                    onerror="this.onerror=null;this.src='{{ $gambarCadangan }}';"
                                    class="kos-image"
                                    alt="Kamar {{ $namaKos }}"
                                    loading="lazy">
                            </div>

                            <div class="card-body">

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="badge bg-primary">
                                        {{ $tipeKos }}
                                    </span>

                                    @if ($ratingKos !== null)
                                        <span class="text-warning fw-semibold">
                                            <i class="bi bi-star-fill"></i>
                                            {{ number_format((float) $ratingKos, 1) }}
                                        </span>
                                    @endif
                                </div>

                                <h5 class="fw-bold">{{ $namaKos }}</h5>

                                <p class="text-secondary small">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $alamatKos }}
                                </p>

                                <div class="border-top pt-3 mt-3">
                                    @if (is_numeric($hargaKos))
                                        <div class="price">
                                            Rp{{ number_format((float) $hargaKos, 0, ',', '.') }}
                                            <small class="text-secondary fw-normal fs-6">/ bulan</small>
                                        </div>
                                    @else
                                        <div class="price">Hubungi pemilik</div>
                                    @endif

                                    <a href="{{ route('kos.index') }}"
                                        class="btn btn-outline-kos w-100 mt-3">
                                        Lihat Pilihan Kos
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="text-center bg-white border rounded-4 p-5">
                            <i class="bi bi-house-exclamation fs-1 text-secondary"></i>
                            <h5 class="fw-bold mt-3">Belum Ada Rekomendasi Kos</h5>
                            <p class="text-secondary mb-3">
                                Belum ada kos dengan jumlah ulasan yang memenuhi kriteria rekomendasi.
                            </p>
                            <a href="{{ route('kos.index') }}" class="btn btn-kos">
                                Lihat Semua Kos
                            </a>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <!-- TENTANG KAMI -->
    <section class="about-section" id="tentang">
        <div class="container">

            <div class="about-box text-center">
                <span class="section-label">TENTANG KAMI</span>

                <h2 class="fw-bold mt-2">Kenalan dengan CariKos</h2>

                <p class="text-secondary mx-auto mt-3 mb-4"
                    style="max-width: 750px; line-height: 1.9;">

                    CariKos merupakan platform pencarian dan pengelolaan
                    informasi kos-kosan berbasis web yang membantu pencari
                    kos menemukan hunian sesuai kebutuhan serta membantu
                    pemilik kos mengelola informasi propertinya dengan lebih mudah.

                </p>

                <a href="{{ route('kos.index') }}" class="btn btn-kos">
                    Mulai Cari Kos <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

        </div>
    </section>

</div>

<script>
    document.getElementById('homeSearchForm').addEventListener('submit', function () {
        const pilihan = document.getElementById('rentRange').value;
        const minHarga = document.getElementById('minHarga');
        const maxHarga = document.getElementById('maxHarga');

        minHarga.value = '';
        maxHarga.value = '';

        if (pilihan === 'under') {
            maxHarga.value = '500000';
        } else if (pilihan === 'middle') {
            minHarga.value = '500000';
            maxHarga.value = '1000000';
        } else if (pilihan === 'above') {
            minHarga.value = '1000000';
        }
    });
</script>

@endsection
