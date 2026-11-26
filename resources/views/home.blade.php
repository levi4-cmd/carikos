@extends('layouts.main')

@section('title', 'CariKos - Cari kos di Bandar Lampung')

@section('content')

<div class="kp-page">

    {{-- HERO --}}
    <section class="kh-hero">
        <div class="container">

            <h1 class="kh-title">Cari kos di sekitar Rajabasa, Bandar Lampung</h1>

            <p class="kh-sub">
                {{ $total }} kos lengkap dengan lokasi di peta, fasilitas,
                rating Google Maps, dan kontak pemilik.
            </p>

            <form method="GET" action="{{ route('kos.index') }}" class="kh-search">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    name="lokasi"
                    placeholder="Ketik nama kos atau area, misalnya Gedong Meneng"
                    aria-label="Lokasi atau nama kos">
                <button type="submit" class="kp-btn-main">Cari Kos</button>
            </form>

            @if($areas->isNotEmpty())
                <div class="kh-areas">
                    <span>Area:</span>
                    @foreach($areas as $area => $count)
                        <a href="{{ route('kos.index', ['lokasi' => $area]) }}">
                            {{ $area }} <small>{{ $count }}</small>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </section>


    {{-- TIPE KOS --}}
    <section class="container kh-section">

        <h2 class="kh-h2">Pilih tipe kos</h2>

        @php
            $tipe = [
                'Putri'     => ['bi-gender-female', 'is-putri'],
                'Putra'     => ['bi-gender-male',   'is-putra'],
                'Campur'    => ['bi-people',        'is-campur'],
                'Kontrakan' => ['bi-house-door',    'is-kontrakan'],
            ];
        @endphp

        <div class="row g-3">
            @foreach($tipe as $nama => [$ikon, $kelas])
                <div class="col-6 col-lg-3">
                    <a href="{{ route('kos.index', ['tipe' => $nama]) }}" class="kh-tile {{ $kelas }}">
                        <span class="kh-tile-icon"><i class="bi {{ $ikon }}"></i></span>
                        <span>
                            <strong>{{ $nama }}</strong>
                            <small>{{ $byType[$nama] ?? 0 }} kos</small>
                        </span>
                    </a>
                </div>
            @endforeach
        </div>

    </section>


    {{-- RATING TERTINGGI --}}
    <section class="container kh-section pb-5">

        <div class="d-flex flex-wrap justify-content-between align-items-end gap-2 mb-3">
            <div>
                <h2 class="kh-h2 mb-1">Rating tertinggi</h2>
                <p class="text-muted small mb-0">Kos dengan rating terbaik dan minimal 10 rating di Google Maps.</p>
            </div>
            <a href="{{ route('kos.index', ['urut' => 'rating']) }}" class="kh-more">Lihat semua kos</a>
        </div>

        <div class="row g-3">
            @forelse($top as $k)
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('kos.detail', $k->id) }}" class="kh-card">

                        <div class="kp-thumb {{ $k->type_class }}" style="height:120px">
                            @include('partials.house')
                            <span class="kp-type">{{ $k->type }}</span>
                        </div>

                        <div class="kh-card-body">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <h3>{{ $k->name }}</h3>
                                <span class="kp-rating">
                                    <i class="bi bi-star-fill"></i>
                                    {{ number_format($k->rating, 1, ',', '.') }}
                                </span>
                            </div>

                            <p class="kh-addr">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $k->address ?: 'Alamat belum tersedia' }}</span>
                            </p>

                            <small class="text-muted">{{ $k->reviews }} rating di Google Maps</small>
                        </div>

                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border">Belum ada data kos.</div>
                </div>
            @endforelse
        </div>

    </section>

</div>

@endsection


@push('styles')
<style>
    .kh-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--kp-navy) 0%, var(--kp-navy-2) 100%);
        color: #fff;
        padding: 3.5rem 0 4.5rem;
    }
    .kh-hero::before,
    .kh-hero::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, .06);
    }
    .kh-hero::before { width: 360px; height: 360px; right: -90px; top: -150px; }
    .kh-hero::after  { width: 240px; height: 240px; left: -80px; bottom: -130px; }
    .kh-hero .container { position: relative; z-index: 1; }

    .kh-title {
        font-weight: 800;
        font-size: clamp(1.9rem, 4.5vw, 3rem);
        line-height: 1.12;
        letter-spacing: -.025em;
        max-width: 20ch;
        margin: 0 0 .9rem;
    }
    .kh-sub {
        max-width: 54ch;
        color: rgba(255, 255, 255, .82);
        line-height: 1.65;
        margin: 0 0 1.75rem;
    }

    .kh-search {
        display: flex;
        align-items: center;
        gap: .5rem;
        max-width: 640px;
        background: #fff;
        border-radius: 14px;
        padding: .45rem .45rem .45rem 1rem;
        box-shadow: 0 18px 40px -18px rgba(0, 0, 0, .55);
    }
    .kh-search > i { color: #6b7d95; }
    .kh-search input {
        flex: 1;
        min-width: 0;
        border: 0;
        outline: 0;
        font-size: .95rem;
        padding: .6rem .25rem;
        color: var(--kp-ink);
        background: transparent;
    }
    .kh-search:focus-within { box-shadow: 0 0 0 .25rem rgba(110, 193, 255, .45); }
    .kh-search .kp-btn-main { padding: 0 1.4rem; }

    .kh-areas {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .5rem;
        margin-top: 1.1rem;
        font-size: .85rem;
        color: rgba(255, 255, 255, .75);
    }
    .kh-areas a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        padding: .3rem .8rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, .3);
        transition: background-color .15s ease;
    }
    .kh-areas a:hover,
    .kh-areas a:focus-visible { background: rgba(255, 255, 255, .15); }
    .kh-areas small { opacity: .7; margin-left: .15rem; }

    .kh-section { padding-top: 2.5rem; }
    .kh-h2 { font-size: 1.35rem; font-weight: 800; letter-spacing: -.01em; margin-bottom: 1rem; }
    .kh-more { font-weight: 700; font-size: .88rem; color: var(--kp-blue); text-decoration: none; }
    .kh-more:hover { text-decoration: underline; }

    .kh-tile {
        display: flex;
        align-items: center;
        gap: .9rem;
        background: #fff;
        border: 1px solid var(--kp-line);
        border-left: 5px solid var(--c, var(--kp-lain));
        border-radius: 14px;
        padding: 1rem 1.1rem;
        color: var(--kp-ink);
        text-decoration: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .kh-tile:hover,
    .kh-tile:focus-visible { border-color: var(--c); box-shadow: 0 10px 24px -16px rgba(18, 48, 90, .6); }
    .kh-tile.is-putri     { --c: var(--kp-putri); }
    .kh-tile.is-putra     { --c: var(--kp-putra); }
    .kh-tile.is-campur    { --c: var(--kp-campur); }
    .kh-tile.is-kontrakan { --c: var(--kp-kontrakan); }
    .kh-tile-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #fff;
        background: var(--c);
        flex-shrink: 0;
    }
    .kh-tile strong { display: block; font-weight: 800; }
    .kh-tile small { color: #5b6c83; }

    .kh-card {
        display: block;
        height: 100%;
        background: #fff;
        border: 1px solid var(--kp-line);
        border-radius: 16px;
        overflow: hidden;
        color: var(--kp-ink);
        text-decoration: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .kh-card:hover,
    .kh-card:focus-visible { border-color: var(--kp-blue); box-shadow: 0 10px 26px -16px rgba(18, 48, 90, .55); }
    .kh-card-body { padding: 1rem 1.1rem 1.1rem; }
    .kh-card h3 { font-size: 1rem; font-weight: 800; line-height: 1.3; margin: 0; }
    .kh-addr { display: flex; gap: .4rem; font-size: .83rem; color: #5b6c83; margin: .4rem 0 .5rem; }
    .kh-addr i { margin-top: .1rem; }

    .kh-search button:focus-visible,
    .kh-areas a:focus-visible,
    .kh-tile:focus-visible,
    .kh-card:focus-visible,
    .kh-more:focus-visible { outline: 3px solid rgba(26, 106, 173, .45); outline-offset: 2px; }

    @media (max-width: 575.98px) {
        .kh-search { flex-wrap: wrap; padding: .6rem; }
        .kh-search > i { display: none; }
        .kh-search input { flex-basis: 100%; padding: .55rem .6rem; }
        .kh-search .kp-btn-main { width: 100%; }
    }

    @media (prefers-reduced-motion: reduce) {
        .kh-tile, .kh-card, .kh-areas a { transition: none; }
    }
</style>
@endpush