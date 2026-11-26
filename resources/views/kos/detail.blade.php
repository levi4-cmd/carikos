
@extends('layouts.main')

@section('title', $kos->name . ' - CariKos')

@section('content')

@php
    $hasCoord = $kos->lat && $kos->lng;
    $facilities = $kos->facilityItems();
    $photos = $kos->photos;
    $primaryPhoto = $photos->firstWhere('is_primary', true) ?? $photos->first();
    $otherPhotos = $photos->filter(function ($photo) use ($primaryPhoto) {
        return !$primaryPhoto || $photo->id !== $primaryPhoto->id;
    });
@endphp

<div class="kp-page">

    {{-- HEADER --}}
    <section class="kd-hero">
        <div class="container">

            <a href="{{ route('kos.index') }}" class="kd-back">
                <i class="bi bi-chevron-left"></i> Kembali ke pencarian
            </a>

            <div class="d-flex flex-wrap align-items-center gap-2 mt-3 mb-2">
                <span class="kd-badge {{ $kos->type_class }}">{{ $kos->type ?: 'Belum diketahui' }}</span>

                @if(!is_null($kos->rating))
                    <span class="kp-rating">
                        <i class="bi bi-star-fill"></i>
                        {{ number_format($kos->rating, 1, ',', '.') }}
                    </span>
                    @if(!is_null($kos->reviews))
                        <span class="kd-reviews">{{ $kos->reviews }} rating di Google Maps</span>
                    @endif
                @else
                    <span class="kp-rating is-empty">Belum ada rating</span>
                @endif
            </div>

            <h1 class="kd-title">{{ $kos->name }}</h1>

            <p class="kd-address">
                <i class="bi bi-geo-alt"></i>
                {{ $kos->address ?: 'Alamat belum tersedia' }}
            </p>

        </div>
    </section>

    <div class="container kd-body">

        <div class="row g-4">

            {{-- KOLOM KIRI --}}
            <div class="col-lg-8">

                {{-- GALERI FOTO KOS --}}
                <div class="kd-card">
                    <h2 class="kd-h2">
                        <i class="bi bi-images"></i> Foto Kos
                    </h2>

                    @if($primaryPhoto)
                        <a href="{{ asset('storage/' . $primaryPhoto->photo_path) }}"
                           target="_blank"
                           class="kd-main-photo">
                            <img
                                src="{{ asset('storage/' . $primaryPhoto->photo_path) }}"
                                alt="Foto {{ $kos->name }}"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                            <div class="kd-photo-error">
                                <i class="bi bi-image"></i>
                                Foto tidak dapat dimuat
                            </div>
                        </a>

                        @if($otherPhotos->isNotEmpty())
                            <div class="kd-photo-gallery">
                                @foreach($otherPhotos as $photo)
                                    <a href="{{ asset('storage/' . $photo->photo_path) }}"
                                       target="_blank"
                                       class="kd-gallery-item">
                                        <img
                                            src="{{ asset('storage/' . $photo->photo_path) }}"
                                            alt="Foto tambahan {{ $kos->name }}"
                                            loading="lazy">
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <p class="kd-photo-count">
                            <i class="bi bi-camera"></i>
                            {{ $photos->count() }} foto tersedia
                        </p>
                    @else
                        <div class="kd-empty-photo">
                            <i class="bi bi-house-door"></i>
                            <strong>Foto belum tersedia</strong>
                            <span>Pemilik kos belum menambahkan foto untuk tempat ini.</span>
                        </div>
                    @endif
                </div>

                {{-- FASILITAS --}}
                <div class="kd-card">
                    <h2 class="kd-h2">Fasilitas</h2>

                    @if($facilities->isNotEmpty())
                        <ul class="kd-facilities">
                            @foreach($facilities as $f)
                                <li>
                                    <i class="bi {{ $f['icon'] }}"></i>
                                    <span>{{ $f['text'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mb-0">Informasi fasilitas belum tersedia.</p>
                    @endif
                </div>

                {{-- CATATAN --}}
                @if(!empty($kos->notes))
                    <div class="kd-card kd-note">
                        <h2 class="kd-h2"><i class="bi bi-info-circle"></i> Catatan</h2>
                        <p class="mb-0">{{ $kos->notes }}</p>
                    </div>
                @endif

                {{-- LOKASI --}}
                @if($hasCoord)
                    <div class="kd-card">
                        <h2 class="kd-h2">Lokasi</h2>
                        <div
                            id="kd-map"
                            data-lat="{{ $kos->lat }}"
                            data-lng="{{ $kos->lng }}"
                            data-type="{{ $kos->type_class }}"
                            role="region"
                            aria-label="Peta lokasi {{ $kos->name }}"></div>
                    </div>
                @endif

            </div>

            {{-- KOLOM KANAN: KONTAK --}}
            <div class="col-lg-4">

                <aside class="kd-card kd-contact">

                    <div class="kd-price">
                        @if($kos->harga_mulai)
                            <span class="kd-price-main">
                                Rp{{ number_format($kos->harga_mulai, 0, ',', '.') }}
                            </span>
                            <span class="kd-price-sub">per bulan, mulai dari</span>
                        @else
                            <span class="kd-price-main">Hubungi pemilik</span>
                            <span class="kd-price-sub">untuk info harga dan ketersediaan kamar</span>
                        @endif
                    </div>

                    @if($kos->whatsapp_url)
                        <a href="{{ $kos->whatsapp_url }}" target="_blank" rel="noopener" class="btn kd-wa w-100">
                            <i class="bi bi-whatsapp"></i> Hubungi lewat WhatsApp
                        </a>
                        <p class="kd-phone"><i class="bi bi-telephone"></i> {{ $kos->phone }}</p>
                    @else
                        <button class="btn btn-light w-100 border" disabled>Kontak belum tersedia</button>
                    @endif

                    @if(!empty($kos->maps_url))
                        <a href="{{ $kos->maps_url }}" target="_blank" rel="noopener" class="btn kd-maps w-100">
                            <i class="bi bi-map"></i> Buka di Google Maps
                        </a>
                    @endif

                    <p class="kd-tip">
                        <i class="bi bi-shield-check"></i>
                        Survei langsung dan konfirmasi harga sebelum melakukan pembayaran.
                    </p>

                </aside>

            </div>

        </div>

        {{-- KOS TERDEKAT --}}
        @if($nearby->isNotEmpty())
            <section class="mt-5">
                <h2 class="kd-h2 mb-3">Kos terdekat</h2>

                <div class="row g-3">
                    @foreach($nearby as $n)
                        <div class="col-12 col-md-4">
                            <a href="{{ route('kos.detail', $n->id) }}" class="kd-near">
                                <span class="kd-badge {{ $n->type_class }}">{{ $n->type }}</span>
                                <strong>{{ $n->name }}</strong>
                                <small>{{ $n->address ?: 'Alamat belum tersedia' }}</small>
                                @if(!is_null($n->rating))
                                    <span class="kp-rating mt-2">
                                        <i class="bi bi-star-fill"></i>
                                        {{ number_format($n->rating, 1, ',', '.') }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>

</div>

@endsection

@push('styles')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

<style>
    .kd-hero {
        background: linear-gradient(135deg, var(--kp-navy) 0%, var(--kp-navy-2) 100%);
        color: #fff;
        padding: 1.75rem 0 4.5rem;
    }

    .kd-back {
        color: rgba(255, 255, 255, .8);
        text-decoration: none;
        font-size: .88rem;
        font-weight: 600;
    }

    .kd-back:hover { color: #fff; text-decoration: underline; }

    .kd-title {
        font-weight: 800;
        font-size: clamp(1.7rem, 4vw, 2.5rem);
        line-height: 1.15;
        letter-spacing: -.02em;
        margin: .25rem 0 .6rem;
    }

    .kd-address { color: rgba(255, 255, 255, .85); margin: 0; }
    .kd-reviews { font-size: .85rem; color: rgba(255, 255, 255, .8); }

    .kd-badge {
        display: inline-block;
        align-self: flex-start;
        font-size: .74rem;
        font-weight: 700;
        padding: .22rem .7rem;
        border-radius: 999px;
        color: #fff;
        background: var(--kp-lain);
    }

    .kd-badge.is-putri { background: var(--kp-putri); }
    .kd-badge.is-putra { background: var(--kp-putra); }
    .kd-badge.is-campur { background: var(--kp-campur); }
    .kd-badge.is-kontrakan { background: var(--kp-kontrakan); }

    .kd-body {
        margin-top: -2.75rem;
        padding-bottom: 3rem;
        position: relative;
        z-index: 2;
    }

    .kd-card {
        background: #fff;
        border: 1px solid var(--kp-line);
        border-radius: 16px;
        padding: 1.4rem 1.5rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 14px 30px -22px rgba(18, 48, 90, .5);
    }

    .kd-h2 {
        font-size: 1.05rem;
        font-weight: 800;
        margin: 0 0 1rem;
    }

    .kd-h2 i { color: var(--kp-blue); margin-right: .3rem; }

    /* GALERI FOTO */
    .kd-main-photo {
        display: block;
        height: 390px;
        border-radius: 12px;
        overflow: hidden;
        background: #edf2f7;
        position: relative;
    }

    .kd-main-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .3s ease;
    }

    .kd-main-photo:hover img { transform: scale(1.025); }

    .kd-photo-error {
        display: none;
        height: 100%;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: .5rem;
        color: var(--kp-muted);
    }

    .kd-photo-error i { font-size: 2rem; }

    .kd-photo-gallery {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-top: 12px;
    }

    .kd-gallery-item {
        display: block;
        height: 125px;
        border-radius: 10px;
        overflow: hidden;
        background: #edf2f7;
    }

    .kd-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .25s ease;
    }

    .kd-gallery-item:hover img { transform: scale(1.06); }

    .kd-photo-count {
        margin: 12px 0 0;
        color: var(--kp-muted);
        font-size: .8rem;
    }

    .kd-empty-photo {
        min-height: 220px;
        border: 1px dashed #cbd5e0;
        border-radius: 12px;
        background: var(--kp-mist);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 25px;
        gap: 8px;
        color: var(--kp-muted);
    }

    .kd-empty-photo i { font-size: 2.5rem; color: #9aabc0; }
    .kd-empty-photo strong { color: var(--kp-ink); }
    .kd-empty-photo span { font-size: .85rem; }

    .kd-facilities {
        display: flex;
        flex-wrap: wrap;
        gap: .55rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .kd-facilities li {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        font-size: .88rem;
        font-weight: 600;
        color: var(--kp-ink);
        background: var(--kp-primary-light);
        padding: .45rem .85rem;
        border-radius: 10px;
    }

    .kd-note { background: #fff9e8; border-color: #f3df9d; }
    .kd-note .kd-h2 i { color: #b7791f; }

    #kd-map {
        height: 320px;
        border-radius: 12px;
        border: 1px solid var(--kp-line);
        z-index: 1;
    }

    .kd-contact {
        position: sticky;
        top: 1rem;
        display: flex;
        flex-direction: column;
        gap: .75rem;
    }

    .kd-price { display: flex; flex-direction: column; line-height: 1.3; }
    .kd-price-main { font-size: 1.35rem; font-weight: 800; color: var(--kp-navy); }
    .kd-price-sub { font-size: .8rem; color: var(--kp-muted); }

    .kd-wa {
        background: #118a4b;
        color: #fff;
        font-weight: 700;
        border-radius: 10px;
        min-height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
    }

    .kd-wa:hover, .kd-wa:focus-visible { background: #0c6e3b; color: #fff; }

    .kd-maps {
        border: 1px solid var(--kp-line);
        color: var(--kp-navy);
        font-weight: 700;
        border-radius: 10px;
        min-height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        background: #fff;
    }

    .kd-maps:hover, .kd-maps:focus-visible {
        background: var(--kp-mist);
        border-color: var(--kp-blue);
        color: var(--kp-blue);
    }

    .kd-phone { margin: -.2rem 0 0; text-align: center; font-size: .85rem; color: var(--kp-muted); }

    .kd-tip {
        margin: .25rem 0 0;
        padding-top: .85rem;
        border-top: 1px dashed var(--kp-line);
        font-size: .8rem;
        color: var(--kp-muted);
        display: flex;
        gap: .5rem;
    }

    .kd-tip i { color: var(--kp-blue); margin-top: .1rem; }

    .kd-near {
        display: flex;
        flex-direction: column;
        gap: .35rem;
        height: 100%;
        background: #fff;
        border: 1px solid var(--kp-line);
        border-radius: 14px;
        padding: 1rem 1.1rem;
        color: var(--kp-ink);
        text-decoration: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .kd-near:hover, .kd-near:focus-visible {
        border-color: var(--kp-blue);
        box-shadow: 0 10px 24px -16px rgba(18, 48, 90, .55);
    }

    .kd-near strong { font-weight: 800; line-height: 1.3; }
    .kd-near small { color: var(--kp-muted); }
    .kd-near .kp-rating { align-self: flex-start; }

    .kd-wa:focus-visible, .kd-maps:focus-visible, .kd-near:focus-visible, .kd-back:focus-visible {
        outline: 3px solid rgba(59, 130, 246, .45);
        outline-offset: 2px;
    }

    .kp-pin span {
        display: block;
        width: 26px;
        height: 26px;
        border-radius: 50% 50% 50% 0;
        background: var(--pin, var(--kp-lain));
        border: 3px solid #fff;
        box-shadow: 0 3px 8px rgba(0, 0, 0, .35);
        transform: rotate(-45deg);
    }

    .kp-pin.is-putri span { --pin: var(--kp-putri); }
    .kp-pin.is-putra span { --pin: var(--kp-putra); }
    .kp-pin.is-campur span { --pin: var(--kp-campur); }
    .kp-pin.is-kontrakan span { --pin: var(--kp-kontrakan); }

    @media (max-width: 575.98px) {
        .kd-main-photo { height: 260px; }
        .kd-gallery-item { height: 90px; }
        .kd-card { padding: 1.1rem; }
    }

    @media (max-width: 991.98px) {
        .kd-contact { position: static; }
    }

    @media (prefers-reduced-motion: reduce) {
        .kd-near, .kd-main-photo img, .kd-gallery-item img { transition: none; }
    }
</style>

@endpush

@push('scripts')

@if($hasCoord)
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('kd-map');

    if (!el || typeof L === 'undefined') {
        return;
    }

    const lat = parseFloat(el.dataset.lat);
    const lng = parseFloat(el.dataset.lng);

    const map = L.map('kd-map', { scrollWheelZoom: false }).setView([lat, lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    L.marker([lat, lng], {
        icon: L.divIcon({
            className: 'kp-pin ' + (el.dataset.type || ''),
            html: '<span></span>',
            iconSize: [26, 26],
            iconAnchor: [13, 26]
        })
    }).addTo(map);
});
</script>
@endif

@endpush
