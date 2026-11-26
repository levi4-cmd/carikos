
@extends('layouts.main')

@section('title', 'Cari Kos - CariKos')

@section('content')

@php
    $facilityIcons = [
        '/wi-?fi/i'        => 'bi-wifi',
        '/parkir/i'        => 'bi-p-square',
        '/cctv/i'          => 'bi-camera-video',
        '/mandi|\bkm\b/i'  => 'bi-droplet',
        '/dapur/i'         => 'bi-cup-hot',
        '/\bac\b/i'        => 'bi-snow',
        '/listrik/i'       => 'bi-lightning-charge',
        '/laundry|cuci/i'  => 'bi-basket',
        '/kasur|bed/i'     => 'bi-moon-stars',
        '/aman|satpam/i'   => 'bi-shield-check',
    ];

    $iconFor = function ($text) use ($facilityIcons) {
        foreach ($facilityIcons as $pattern => $icon) {
            if (preg_match($pattern, $text)) {
                return $icon;
            }
        }

        return 'bi-check2';
    };

    $typeClass = fn ($type) => match (mb_strtolower((string) $type)) {
        'putri'     => 'is-putri',
        'putra'     => 'is-putra',
        'campur'    => 'is-campur',
        'kontrakan' => 'is-kontrakan',
        default     => 'is-lain',
    };

    $tipeOptions = [
        ''                => 'Semua',
        'Putra'           => 'Putra',
        'Putri'           => 'Putri',
        'Campur'          => 'Campur',
        'Kontrakan'       => 'Kontrakan',
        'Belum diketahui' => 'Belum diketahui',
    ];
@endphp

<div class="kp-page">

    {{-- HERO --}}
    <section class="kp-hero">
        <div class="container">
            <span class="kp-hero-badge">
                <i class="bi bi-house-heart-fill"></i>
                Temukan tempat tinggal nyaman
            </span>

            <h1 class="kp-hero-title">
                Cari kos yang pas buat kamu
            </h1>

            <p class="kp-hero-sub">
                Bandingkan lokasi, fasilitas, dan kontak pemilik kos dalam satu halaman.
            </p>
        </div>
    </section>

    {{-- FORM PENCARIAN --}}
    <div class="container kp-search-wrap">

        <form method="GET" action="{{ route('kos.index') }}" class="kp-search">

            <div class="row g-3 align-items-end">

                <div class="col-12 col-lg-5">
                    <label for="f-lokasi" class="kp-label">Lokasi atau nama kos</label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-geo-alt"></i>
                        </span>

                        <input
                            id="f-lokasi"
                            name="lokasi"
                            value="{{ request('lokasi') }}"
                            class="form-control"
                            placeholder="Contoh: Rajabasa">
                    </div>
                </div>

                <div class="col-6 col-lg-2">
                    <label for="f-min" class="kp-label">Harga minimum</label>

                    <div class="input-group">
                        <span class="input-group-text">Rp</span>

                        <input
                            id="f-min"
                            name="min_harga"
                            type="number"
                            min="0"
                            value="{{ request('min_harga') }}"
                            class="form-control"
                            placeholder="0">
                    </div>
                </div>

                <div class="col-6 col-lg-2">
                    <label for="f-max" class="kp-label">Harga maksimum</label>

                    <div class="input-group">
                        <span class="input-group-text">Rp</span>

                        <input
                            id="f-max"
                            name="max_harga"
                            type="number"
                            min="0"
                            value="{{ request('max_harga') }}"
                            class="form-control"
                            placeholder="0">
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <button class="btn kp-btn-main w-100" type="submit">
                        <i class="bi bi-search"></i>
                        Cari Kos
                    </button>
                </div>

            </div>

            <div class="kp-chip-row">

                <div class="kp-chips" role="radiogroup" aria-label="Tipe kos">

                    @foreach($tipeOptions as $value => $label)
                        <label class="kp-chip">
                            <input
                                type="radio"
                                name="tipe"
                                value="{{ $value }}"
                                @checked((string) request('tipe') === (string) $value)
                                onchange="this.form.submit()">

                            <span>{{ $label }}</span>
                        </label>
                    @endforeach

                </div>

                <a href="{{ route('kos.index') }}" class="kp-reset">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset filter
                </a>

            </div>

        </form>

    </div>

    {{-- HASIL PENCARIAN --}}
    <div class="container pb-5 mt-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">

            <div>
                <h2 class="kp-section-title mb-1">Daftar Kos</h2>

                <p class="text-muted mb-0 small">
                    Menampilkan {{ count($kos) }} dari {{ $total }} tempat yang terdata.
                </p>
            </div>

            <select
                class="form-select form-select-sm kp-sort"
                aria-label="Urutkan daftar kos"
                onchange="location.href=this.value">

                <option
                    value="{{ route('kos.index', request()->except('urut')) }}"
                    @selected(request('urut') !== 'rating')>
                    Urutkan: Nama
                </option>

                <option
                    value="{{ route('kos.index', array_merge(request()->except('urut'), ['urut' => 'rating'])) }}"
                    @selected(request('urut') === 'rating')>
                    Rating tertinggi
                </option>

            </select>

        </div>

        <div class="row g-4 kp-layout" id="kp-layout">

            {{-- DAFTAR KOS --}}
            <div class="col-lg-6 kp-list-col">

                <div class="kp-list">

                    @forelse($kos as $item)

                        @php
                            $cls = $typeClass($item['type'] ?? '');

                            $facilityList = collect(explode(',', (string) ($item['facilities'] ?? '')))
                                ->map(fn ($f) => trim($f))
                                ->filter()
                                ->values();

                            $shownFacilities = $facilityList->take(4);
                            $extraFacilities = $facilityList->count() - $shownFacilities->count();

                            $hasCoord = is_numeric($item['lat'] ?? null)
                                && is_numeric($item['lng'] ?? null)
                                && (float) $item['lat'] != 0
                                && (float) $item['lng'] != 0;
                        @endphp

                        <article class="kp-card" data-id="{{ $item['id'] }}">

                            {{-- GAMBAR SEMENTARA --}}
                            <div class="kp-thumb {{ $cls }}">
                                <div class="kp-thumb-content">
                                    <i class="bi bi-house-door-fill"></i>
                                    <span>Foto kos</span>
                                </div>

                                <span class="kp-type">
                                    {{ $item['type'] ?: 'Belum diketahui' }}
                                </span>
                            </div>

                            <div class="kp-body">

                                <div class="d-flex justify-content-between align-items-start gap-2">

                                    <h3 class="kp-name">
                                        {{ $item['name'] }}
                                    </h3>

                                    @if(!is_null($item['rating']))
                                        <span class="kp-rating" title="Rating Google Maps">
                                            <i class="bi bi-star-fill"></i>
                                            {{ number_format($item['rating'], 1, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="kp-rating is-empty">
                                            Belum ada rating
                                        </span>
                                    @endif

                                </div>

                                <p class="kp-address">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>
                                        {{ $item['address'] ?: 'Alamat belum tersedia' }}
                                    </span>
                                </p>

                                @if($shownFacilities->isNotEmpty())

                                    <ul class="kp-facilities">

                                        @foreach($shownFacilities as $facility)
                                            <li title="{{ $facility }}">
                                                <i class="bi {{ $iconFor($facility) }}"></i>
                                                <span>{{ $facility }}</span>
                                            </li>
                                        @endforeach

                                        @if($extraFacilities > 0)
                                            <li class="is-more">
                                                +{{ $extraFacilities }} lainnya
                                            </li>
                                        @endif

                                    </ul>

                                @else
                                    <p class="kp-muted-line">
                                        Informasi fasilitas belum tersedia.
                                    </p>
                                @endif

                                @if(!empty($item['notes']))
                                    <p class="kp-notes">
                                        {{ $item['notes'] }}
                                    </p>
                                @endif

                                <div class="kp-foot">

                                    <div class="kp-price">

                                        @if(!is_null($item['harga_mulai']))
                                            <span class="kp-price-main">
                                                Mulai Rp{{ number_format($item['harga_mulai'], 0, ',', '.') }}
                                            </span>

                                            <span class="kp-price-sub">
                                                Harga mulai per bulan
                                            </span>
                                        @else
                                            <span class="kp-price-main">
                                                Hubungi pemilik
                                            </span>

                                            <span class="kp-price-sub">
                                                Untuk info harga
                                            </span>
                                        @endif

                                    </div>

                                    <div class="kp-actions">

                                        @if($hasCoord)
                                            <button
                                                type="button"
                                                class="btn kp-icon-btn kp-locate"
                                                data-id="{{ $item['id'] }}"
                                                title="Lihat di peta"
                                                aria-label="Lihat {{ $item['name'] }} di peta">
                                                <i class="bi bi-pin-map"></i>
                                            </button>
                                        @endif

                                        @if(!empty($item['maps_url']))
                                            <a
                                                class="btn kp-icon-btn"
                                                target="_blank"
                                                rel="noopener"
                                                href="{{ $item['maps_url'] }}"
                                                title="Buka Google Maps"
                                                aria-label="Buka {{ $item['name'] }} di Google Maps">
                                                <i class="bi bi-map"></i>
                                            </a>
                                        @endif

                                        @if(!empty($item['phone']))
                                            <a
                                                class="btn kp-icon-btn is-wa"
                                                target="_blank"
                                                rel="noopener"
                                                href="https://wa.me/62{{ ltrim(preg_replace('/\D/', '', $item['phone']), '0') }}"
                                                title="Hubungi lewat WhatsApp"
                                                aria-label="Hubungi {{ $item['name'] }} lewat WhatsApp">
                                                <i class="bi bi-whatsapp"></i>
                                            </a>
                                        @endif

                                        <a
                                            href="{{ route('kos.detail', $item['id']) }}"
                                            class="btn kp-btn-main btn-sm">
                                            Lihat Detail
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </article>

                    @empty

                        <div class="kp-empty">
                            <i class="bi bi-search"></i>

                            <h3>Belum ada kos yang cocok</h3>

                            <p>
                                Coba perluas rentang harga, ganti kata kunci lokasi,
                                atau pilih tipe "Semua".
                            </p>

                            <a href="{{ route('kos.index') }}" class="btn kp-btn-main btn-sm">
                                Reset filter
                            </a>
                        </div>

                    @endforelse

                </div>

            </div>

            {{-- PETA --}}
            <div class="col-lg-6 kp-map-col">

                <div class="kp-map-sticky">

                    <h2 class="kp-map-title">
                        <i class="bi bi-geo-alt-fill"></i>
                        Peta {{ count($kos) }} lokasi kos
                    </h2>

                    <div id="kos-map" role="region" aria-label="Peta lokasi kos"></div>

                    <p class="small text-muted mt-2 mb-0">
                        Arahkan kursor ke kartu untuk menyorot titik di peta.
                        Klik penanda untuk melihat info dan membuka Google Maps.
                    </p>

                </div>

            </div>

        </div>

    </div>

    {{-- TOMBOL PETA HP --}}
    <button type="button" id="kp-toggle-map" class="kp-toggle-map d-lg-none">
        <i class="bi bi-map"></i>
        <span>Lihat peta</span>
    </button>

</div>

@endsection

@push('styles')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

<style>
    .kp-page {
        --kp-blue: var(--kp-primary-dark);
        --kp-sky: #93C5FD;
        --kp-line: #e1e8f1;
        --kp-putri: #c2417a;
        --kp-putra: #1a6aad;
        --kp-campur: #0f8f84;
        --kp-kontrakan: #a86a12;
        --kp-lain: #64748b;

        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--kp-mist);
        color: var(--kp-ink);
        min-height: 100vh;
    }

    /* HERO */
    .kp-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--kp-navy) 0%, var(--kp-navy-2) 100%);
        color: #fff;
        padding: 3.5rem 0 6.5rem;
    }

    .kp-hero::before,
    .kp-hero::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, .07);
        pointer-events: none;
    }

    .kp-hero::before {
        width: 320px;
        height: 320px;
        right: -80px;
        top: -140px;
    }

    .kp-hero::after {
        width: 220px;
        height: 220px;
        left: -70px;
        bottom: -120px;
    }

    .kp-hero .container {
        position: relative;
        z-index: 1;
    }

    .kp-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .45rem .85rem;
        border-radius: 999px;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.25);
        color: #fff;
        font-size: .8rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .kp-hero-title {
        color: #fff;
        font-weight: 800;
        font-size: clamp(1.9rem, 4vw, 2.7rem);
        line-height: 1.2;
        letter-spacing: -.02em;
        margin: 0 0 .7rem;
        max-width: 18ch;
        text-shadow: 0 2px 12px rgba(0,0,0,.25);
    }

    .kp-hero-sub {
        margin: 0;
        max-width: 52ch;
        color: #eaf4ff;
        line-height: 1.7;
        font-size: .96rem;
    }

    /* SEARCH */
    .kp-search-wrap {
        margin-top: -4.25rem;
        position: relative;
        z-index: 2;
    }

    .kp-search {
        background: #fff;
        border-radius: 18px;
        padding: 1.5rem;
        box-shadow: 0 18px 40px -18px rgba(18,48,90,.45);
        border: 1px solid rgba(225,232,241,.8);
    }

    .kp-label {
        display: block;
        font-size: .8rem;
        font-weight: 700;
        margin-bottom: .4rem;
        color: var(--kp-ink);
    }

    .kp-search .form-control,
    .kp-search .input-group-text {
        border-color: var(--kp-line);
        background: var(--kp-mist);
        min-height: 46px;
        font-size: .93rem;
    }

    .kp-search .input-group-text {
        color: #6b7d95;
    }

    .kp-search .form-control:focus {
        background: #fff;
        border-color: var(--kp-blue);
        box-shadow: 0 0 0 .2rem rgba(59,130,246,.15);
    }

    .kp-btn-main {
        background: var(--kp-blue);
        border: 0;
        color: #fff;
        font-weight: 700;
        border-radius: 10px;
        min-height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .45rem;
        text-decoration: none;
        transition: background-color .15s ease;
    }

    .kp-btn-main.btn-sm {
        min-height: 38px;
        padding: 0 1rem;
        font-size: .85rem;
    }

    .kp-btn-main:hover,
    .kp-btn-main:focus-visible {
        background: var(--kp-navy);
        color: #fff;
    }

    .kp-chip-row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        margin-top: 1.1rem;
        padding-top: 1.1rem;
        border-top: 1px solid var(--kp-line);
    }

    .kp-chips {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
    }

    .kp-chip {
        position: relative;
        margin: 0;
        cursor: pointer;
    }

    .kp-chip input {
        position: absolute;
        opacity: 0;
        inset: 0;
        cursor: pointer;
    }

    .kp-chip span {
        display: inline-block;
        padding: .4rem .95rem;
        border-radius: 999px;
        border: 1px solid var(--kp-line);
        background: #fff;
        font-size: .85rem;
        font-weight: 600;
        color: var(--kp-ink);
        transition: .15s ease;
    }

    .kp-chip:hover span {
        border-color: var(--kp-blue);
        color: var(--kp-blue);
    }

    .kp-chip input:checked + span {
        background: var(--kp-navy);
        border-color: var(--kp-navy);
        color: #fff;
    }

    .kp-chip input:focus-visible + span {
        outline: 3px solid rgba(59,130,246,.45);
        outline-offset: 2px;
    }

    .kp-reset {
        font-size: .85rem;
        font-weight: 700;
        color: var(--kp-blue);
        text-decoration: none;
    }

    .kp-reset:hover {
        text-decoration: underline;
    }

    /* JUDUL */
    .kp-section-title {
        font-size: 1.25rem;
        font-weight: 800;
        letter-spacing: -.01em;
    }

    .kp-sort {
        max-width: 200px;
        border-color: var(--kp-line);
        border-radius: 10px;
    }

    /* KARTU KOS */
    .kp-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .kp-card {
        display: flex;
        background: #fff;
        border: 1px solid var(--kp-line);
        border-radius: 16px;
        overflow: hidden;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .kp-card:hover,
    .kp-card.is-active {
        border-color: var(--kp-blue);
        box-shadow: 0 10px 26px -16px rgba(18,48,90,.55);
    }

    .kp-thumb {
        position: relative;
        flex: 0 0 132px;
        min-height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: linear-gradient(160deg, #8497ae, #64748b);
    }

    .kp-thumb.is-putri {
        background: linear-gradient(160deg, #e0699a, var(--kp-putri));
    }

    .kp-thumb.is-putra {
        background: linear-gradient(160deg, #3b8fd6, var(--kp-putra));
    }

    .kp-thumb.is-campur {
        background: linear-gradient(160deg, #25b5a8, var(--kp-campur));
    }

    .kp-thumb.is-kontrakan {
        background: linear-gradient(160deg, #d39236, var(--kp-kontrakan));
    }

    .kp-thumb-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .5rem;
        color: rgba(255,255,255,.9);
        font-size: .8rem;
        font-weight: 700;
    }

    .kp-thumb-content i {
        font-size: 3rem;
    }

    .kp-type {
        position: absolute;
        left: .6rem;
        top: .6rem;
        background: #fff;
        color: var(--kp-ink);
        font-size: .72rem;
        font-weight: 700;
        padding: .2rem .55rem;
        border-radius: 999px;
    }

    .kp-body {
        flex: 1;
        min-width: 0;
        padding: 1rem 1.1rem;
        display: flex;
        flex-direction: column;
    }

    .kp-name {
        font-size: 1.05rem;
        font-weight: 800;
        line-height: 1.3;
        margin: 0;
        letter-spacing: -.01em;
    }

    .kp-rating {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        font-size: .8rem;
        font-weight: 700;
        color: #8a5a00;
        background: #fff4d6;
        padding: .22rem .6rem;
        border-radius: 999px;
        white-space: nowrap;
    }

    .kp-rating i {
        color: #f2a900;
        font-size: .72rem;
    }

    .kp-rating.is-empty {
        color: #6b7d95;
        background: #eef2f7;
        font-weight: 600;
    }

    .kp-address {
        display: flex;
        gap: .4rem;
        margin: .35rem 0 .7rem;
        font-size: .83rem;
        color: var(--kp-muted);
    }

    .kp-address i {
        margin-top: .1rem;
    }

    .kp-facilities {
        display: flex;
        flex-wrap: wrap;
        gap: .4rem;
        list-style: none;
        padding: 0;
        margin: 0 0 .7rem;
    }

    .kp-facilities li {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        max-width: 100%;
        font-size: .76rem;
        font-weight: 600;
        color: var(--kp-ink);
        background: var(--kp-primary-light);
        padding: .25rem .6rem;
        border-radius: 8px;
    }

    .kp-facilities li span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 190px;
    }

    .kp-facilities li.is-more {
        background: transparent;
        color: #6b7d95;
        padding-left: .2rem;
    }

    .kp-muted-line {
        font-size: .8rem;
        color: #6b7d95;
        margin: 0 0 .7rem;
    }

    .kp-notes {
        font-size: .8rem;
        color: var(--kp-muted);
        margin: 0 0 .7rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .kp-foot {
        margin-top: auto;
        padding-top: .8rem;
        border-top: 1px dashed var(--kp-line);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: .6rem;
    }

    .kp-price {
        display: flex;
        flex-direction: column;
        line-height: 1.25;
    }

    .kp-price-main {
        font-weight: 800;
        font-size: .92rem;
        color: var(--kp-navy);
    }

    .kp-price-sub {
        font-size: .72rem;
        color: #6b7d95;
    }

    .kp-actions {
        display: flex;
        align-items: center;
        gap: .4rem;
    }

    .kp-icon-btn {
        width: 38px;
        height: 38px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: 1px solid var(--kp-line);
        background: #fff;
        color: var(--kp-navy);
        transition: .15s ease;
    }

    .kp-icon-btn:hover,
    .kp-icon-btn:focus-visible {
        background: var(--kp-mist);
        border-color: var(--kp-blue);
        color: var(--kp-blue);
    }

    .kp-icon-btn.is-wa {
        color: #118a4b;
    }

    .kp-icon-btn.is-wa:hover,
    .kp-icon-btn.is-wa:focus-visible {
        background: #e7f8ee;
        border-color: #118a4b;
        color: #0c6e3b;
    }

    /* KOSONG */
    .kp-empty {
        background: #fff;
        border: 1px dashed #c5d2e3;
        border-radius: 16px;
        padding: 2.5rem 1.5rem;
        text-align: center;
    }

    .kp-empty i {
        font-size: 2rem;
        color: var(--kp-blue);
    }

    .kp-empty h3 {
        font-size: 1.05rem;
        font-weight: 800;
        margin: .6rem 0 .35rem;
    }

    .kp-empty p {
        color: var(--kp-muted);
        font-size: .9rem;
        margin-bottom: 1rem;
    }

    /* PETA */
    .kp-map-sticky {
        position: sticky;
        top: 1rem;
    }

    .kp-map-title {
        font-size: 1rem;
        font-weight: 800;
        margin: 0 0 .7rem;
    }

    .kp-map-title i {
        color: var(--kp-blue);
    }

    #kos-map {
        height: min(680px, calc(100vh - 7rem));
        min-height: 420px;
        width: 100%;
        border-radius: 16px;
        border: 1px solid var(--kp-line);
        background: #e9eef5;
        z-index: 1;
    }

    .kp-pin span {
        display: block;
        width: 26px;
        height: 26px;
        border-radius: 50% 50% 50% 0;
        background: var(--pin, var(--kp-lain));
        border: 3px solid #fff;
        box-shadow: 0 3px 8px rgba(0,0,0,.35);
        transform: rotate(-45deg);
        transition: transform .15s ease;
    }

    .kp-pin.is-putri span {
        --pin: var(--kp-putri);
    }

    .kp-pin.is-putra span {
        --pin: var(--kp-putra);
    }

    .kp-pin.is-campur span {
        --pin: var(--kp-campur);
    }

    .kp-pin.is-kontrakan span {
        --pin: var(--kp-kontrakan);
    }

    .kp-pin.is-active span {
        transform: rotate(-45deg) scale(1.35);
    }

    .leaflet-popup-content-wrapper {
        border-radius: 12px;
    }

    .leaflet-popup-content {
        margin: .8rem 1rem;
        line-height: 1.5;
        font-family: inherit;
    }

    .kp-pop-name {
        font-weight: 800;
        font-size: .95rem;
    }

    .kp-pop-meta {
        font-size: .78rem;
        color: var(--kp-muted);
    }

    .kp-pop-link {
        display: inline-block;
        margin-top: .4rem;
        font-weight: 700;
        font-size: .8rem;
    }

    /* TOMBOL PETA HP */
    .kp-toggle-map {
        position: fixed;
        left: 50%;
        bottom: 1.25rem;
        transform: translateX(-50%);
        z-index: 1030;
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        border: 0;
        border-radius: 999px;
        padding: .7rem 1.3rem;
        background: var(--kp-navy);
        color: #fff;
        font-weight: 700;
        font-size: .9rem;
        box-shadow: 0 10px 24px -8px rgba(18,48,90,.7);
    }

    @media (max-width: 991.98px) {
        .kp-map-col {
            display: none;
        }

        .kp-layout.show-map .kp-map-col {
            display: block;
        }

        .kp-layout.show-map .kp-list-col {
            display: none;
        }

        .kp-map-sticky {
            position: static;
        }

        #kos-map {
            height: 70vh;
        }

        .kp-page {
            padding-bottom: 4.5rem;
        }
    }

    @media (max-width: 575.98px) {
        .kp-search {
            padding: 1.1rem;
        }

        .kp-card {
            flex-direction: column;
        }

        .kp-thumb {
            flex-basis: auto;
            min-height: 120px;
        }

        .kp-thumb-content i {
            font-size: 2.5rem;
        }

        .kp-actions {
            width: 100%;
        }

        .kp-actions .kp-btn-main {
            margin-left: auto;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .kp-card,
        .kp-chip span,
        .kp-pin span,
        .kp-btn-main,
        .kp-icon-btn {
            transition: none;
        }
    }
</style>

@endpush

@push('scripts')

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const kosData = {{ Illuminate\Support\Js::from($kos) }};

    const mapElement = document.getElementById('kos-map');

    if (!mapElement || typeof L === 'undefined') {
        return;
    }

    const map = L.map('kos-map').setView([-5.367, 105.239], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    const bounds = [];
    const markers = {};

    function typeClass(type) {
        switch (String(type || '').toLowerCase()) {
            case 'putri':     return 'is-putri';
            case 'putra':     return 'is-putra';
            case 'campur':    return 'is-campur';
            case 'kontrakan': return 'is-kontrakan';
            default:          return 'is-lain';
        }
    }

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, function (char) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[char];
        });
    }

    const list = Array.isArray(kosData)
        ? kosData
        : Object.values(kosData || {});

    list.forEach(function (kos) {

        const lat = Number(kos.lat);
        const lng = Number(kos.lng);

        if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
            return;
        }

        if (lat === 0 || lng === 0) {
            return;
        }

        const icon = L.divIcon({
            className: 'kp-pin ' + typeClass(kos.type),
            html: '<span></span>',
            iconSize: [26, 26],
            iconAnchor: [13, 26],
            popupAnchor: [0, -24]
        });

        const marker = L.marker([lat, lng], {
            icon: icon
        }).addTo(map);

        const rating = kos.rating === null || kos.rating === undefined
            ? 'Belum ada rating'
            : '★ ' + String(kos.rating).replace('.', ',');

        const mapsLink = kos.maps_url
            ? `<a class="kp-pop-link" href="${escapeHtml(kos.maps_url)}" target="_blank" rel="noopener">Buka Google Maps</a>`
            : '';

        marker.bindPopup(`
            <div style="min-width:190px">
                <div class="kp-pop-name">${escapeHtml(kos.name)}</div>
                <div class="kp-pop-meta">${escapeHtml(kos.type || 'Belum diketahui')} · ${rating}</div>
                <div class="kp-pop-meta">${escapeHtml(kos.address || 'Alamat belum tersedia')}</div>
                ${mapsLink}
            </div>
        `);

        marker.on('click', function () {
            const card = document.querySelector('.kp-card[data-id="' + kos.id + '"]');

            if (card && window.matchMedia('(min-width: 992px)').matches) {
                card.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });

        markers[kos.id] = marker;
        bounds.push([lat, lng]);

    });

    if (bounds.length > 0) {
        map.fitBounds(bounds, {
            padding: [24, 24]
        });
    }

    function setActive(id, on) {
        const marker = markers[id];

        if (!marker) return;

        const el = marker.getElement();

        if (el) {
            el.classList.toggle('is-active', on);
        }

        marker.setZIndexOffset(on ? 1000 : 0);
    }

    document.querySelectorAll('.kp-card').forEach(function (card) {

        const id = card.dataset.id;

        card.addEventListener('mouseenter', function () {
            setActive(id, true);
        });

        card.addEventListener('mouseleave', function () {
            setActive(id, false);
        });

        card.addEventListener('focusin', function () {
            setActive(id, true);
        });

        card.addEventListener('focusout', function () {
            setActive(id, false);
        });

    });

    const layout = document.getElementById('kp-layout');
    const toggle = document.getElementById('kp-toggle-map');

    const isMobile = function () {
        return window.matchMedia('(max-width: 991.98px)').matches;
    };

    function showMap(on) {

        layout.classList.toggle('show-map', on);

        if (toggle) {
            toggle.querySelector('span').textContent = on
                ? 'Lihat daftar'
                : 'Lihat peta';

            toggle.querySelector('i').className = 'bi ' + (
                on ? 'bi-list-ul' : 'bi-map'
            );
        }

        setTimeout(function () {
            map.invalidateSize();
        }, 50);
    }

    if (toggle) {
        toggle.addEventListener('click', function () {
            showMap(!layout.classList.contains('show-map'));
        });
    }

    document.querySelectorAll('.kp-locate').forEach(function (btn) {

        btn.addEventListener('click', function () {

            const marker = markers[btn.dataset.id];

            if (!marker) return;

            if (isMobile()) {
                showMap(true);
            }

            setTimeout(function () {

                map.flyTo(marker.getLatLng(), 17, {
                    duration: 0.6
                });

                marker.openPopup();

            }, isMobile() ? 120 : 0);

        });

    });

});
</script>

@endpush
