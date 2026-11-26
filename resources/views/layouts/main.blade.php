
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'CariKos')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --kp-primary: #3B82F6;
            --kp-primary-dark: #2563EB;
            --kp-primary-hover: #1D4ED8;
            --kp-primary-light: #EFF6FF;

            --kp-navy: #0F172A;
            --kp-navy-2: #1E293B;
            --kp-ink: #334155;
            --kp-muted: #64748b;

            --kp-mist: #f8fafc;
            --kp-white: #ffffff;
            --kp-line: #e5eaf1;

            --kp-putri: #c2417a;
            --kp-putra: #1a6aad;
            --kp-campur: #0f8f84;
            --kp-kontrakan: #a86a12;
            --kp-lain: #64748b;

            --bs-primary: #3B82F6;
            --bs-primary-rgb: 59, 130, 246;
            --bs-link-color: #2563EB;
            --bs-link-hover-color: #1D4ED8;
            --bs-body-font-family: 'Plus Jakarta Sans', sans-serif;
            --bs-body-color: #334155;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: var(--kp-mist);
            color: var(--kp-ink);
            font-size: 14px;
            line-height: 1.65;
        }

        a {
            transition: color .2s ease, background-color .2s ease;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--kp-navy);
            font-weight: 800;
            letter-spacing: -.025em;
        }

        p {
            color: inherit;
        }

        /* NAVBAR */

        .kp-nav {
            background: var(--kp-navy);
            padding: .8rem 0;
            box-shadow: 0 3px 15px rgba(15, 23, 42, .08);
        }

        .kp-brand {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -.04em;
            color: #fff;
            text-decoration: none;
        }

        .kp-brand span {
            color: var(--kp-primary);
        }

        .kp-brand:hover {
            color: #fff;
        }

        .kp-nav .nav-link {
            color: rgba(255, 255, 255, .8);
            font-weight: 600;
            font-size: .9rem;
            border-radius: 9px;
            padding: .55rem .9rem;
        }

        .kp-nav .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .08);
        }

        .kp-nav .nav-link.active {
            color: #fff;
            background: rgba(59, 130, 246, .2);
        }

        .kp-nav-ghost {
            color: #fff;
            font-weight: 600;
            font-size: .9rem;
            text-decoration: none;
            padding: .55rem .9rem;
            border-radius: 10px;
        }

        .kp-nav-ghost:hover {
            background: rgba(255, 255, 255, .12);
            color: #fff;
        }

        .kp-nav-cta {
            background: var(--kp-primary-dark);
            color: #fff;
            font-weight: 700;
            font-size: .9rem;
            text-decoration: none;
            padding: .6rem 1.15rem;
            border-radius: 10px;
            text-align: center;
        }

        .kp-nav-cta:hover {
            background: var(--kp-primary-hover);
            color: #fff;
        }

        .kp-user {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            background: transparent;
            border: 0;
            color: #fff;
            font-weight: 600;
            font-size: .9rem;
            padding: .3rem .5rem;
            border-radius: 10px;
        }

        .kp-user:hover {
            background: rgba(255, 255, 255, .12);
        }

        .kp-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--kp-primary-dark);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .kp-nav a:focus-visible,
        .kp-nav button:focus-visible {
            outline: 3px solid rgba(59, 130, 246, .55);
            outline-offset: 2px;
        }

        /* TOMBOL GLOBAL */

        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: .55rem 1rem;
            transition: all .2s ease;
        }

        .btn-primary {
            background: var(--kp-primary-dark);
            border-color: var(--kp-primary-dark);
            color: #fff;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: var(--kp-primary-hover);
            border-color: var(--kp-primary-hover);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-outline-primary {
            color: var(--kp-primary-dark);
            border-color: var(--kp-primary);
        }

        .btn-outline-primary:hover {
            background: var(--kp-primary-dark);
            border-color: var(--kp-primary-dark);
            color: #fff;
        }

        .btn-dark {
            background: var(--kp-navy);
            border-color: var(--kp-navy);
        }

        .btn-dark:hover {
            background: var(--kp-navy-2);
            border-color: var(--kp-navy-2);
        }

        .kp-btn-main {
            background: var(--kp-primary-dark);
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
            padding: .65rem 1.2rem;
            transition: all .2s ease;
        }

        .kp-btn-main:hover,
        .kp-btn-main:focus-visible {
            background: var(--kp-primary-hover);
            color: #fff;
            transform: translateY(-1px);
        }

        /* CARD GLOBAL */

        .card {
            border: 1px solid var(--kp-line);
            border-radius: 16px;
            box-shadow: 0 3px 15px rgba(15, 23, 42, .035);
            overflow: hidden;
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid var(--kp-line);
            font-weight: 700;
            color: var(--kp-navy);
            padding: 1rem 1.25rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-footer {
            background: #fff;
            border-top: 1px solid var(--kp-line);
        }

        /* FORM GLOBAL */

        .form-label {
            color: var(--kp-navy);
            font-weight: 700;
            font-size: .88rem;
            margin-bottom: .45rem;
        }

        .form-control,
        .form-select {
            min-height: 44px;
            border: 1px solid #dce3ec;
            border-radius: 10px;
            color: var(--kp-ink);
            font-size: .9rem;
            background-color: #fff;
        }

        textarea.form-control {
            min-height: 110px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--kp-primary);
            box-shadow: 0 0 0 .2rem rgba(59, 130, 246, .12);
        }

        .form-control::placeholder {
            color: #9aa6b5;
        }

        .input-group-text {
            background: #f8fafc;
            border-color: #dce3ec;
            color: var(--kp-muted);
            border-radius: 10px;
        }

        /* TABEL GLOBAL */

        .table {
            --bs-table-color: var(--kp-ink);
            --bs-table-border-color: var(--kp-line);
            vertical-align: middle;
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8fafc;
            color: var(--kp-navy);
            font-size: .8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .035em;
            padding: .9rem .85rem;
            white-space: nowrap;
        }

        .table tbody td {
            padding: .85rem;
            font-size: .88rem;
        }

        .table tbody tr:hover {
            background: #F8FAFC;
        }

        /* BADGE GLOBAL */

        .badge {
            font-weight: 700;
            letter-spacing: .01em;
            padding: .45em .7em;
            border-radius: 7px;
        }

        .text-primary {
            color: var(--kp-primary-dark) !important;
        }

        .bg-primary {
            background-color: var(--kp-primary-dark) !important;
        }

        .bg-primary-subtle {
            background-color: var(--kp-primary-light) !important;
        }

        .border-primary {
            border-color: var(--kp-primary) !important;
        }

        /* DROPDOWN */

        .dropdown-menu {
            border: 1px solid var(--kp-line);
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .12);
            padding: .5rem;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: .6rem .75rem;
            font-size: .88rem;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: var(--kp-primary-light);
            color: var(--kp-primary-dark);
        }

        /* ALERT */

        .alert {
            border: 0;
            border-radius: 12px;
            padding: .9rem 1rem;
        }

        /* PAGINATION */

        .pagination {
            gap: 5px;
        }

        .page-link {
            border: 1px solid var(--kp-line);
            border-radius: 8px !important;
            color: var(--kp-navy);
            font-weight: 600;
        }

        .page-link:hover {
            background: var(--kp-primary-light);
            color: var(--kp-primary-dark);
            border-color: #BFDBFE;
        }

        .page-item.active .page-link {
            background: var(--kp-primary-dark);
            border-color: var(--kp-primary-dark);
            color: #fff;
        }

        /* KOMPONEN KOS */

        .kp-thumb {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(160deg, #8497ae, var(--kp-lain));
        }

        .kp-thumb svg {
            width: 64px;
            height: auto;
            opacity: .95;
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

        .kp-rating {
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

        /* FOOTER */

        .kp-footer {
            background: #fff;
            border-top: 1px solid var(--kp-line);
            padding: 1.5rem 0;
            font-size: .82rem;
            color: #64748b;
            margin-top: auto;
        }

        .kp-footer strong {
            color: var(--kp-navy);
        }

        /* RESPONSIVE */

        @media (max-width: 767.98px) {
            body {
                font-size: 13px;
            }

            .kp-nav {
                padding: .65rem 0;
            }

            .kp-brand {
                font-size: 1.35rem;
            }

            .card-body {
                padding: 1rem;
            }

            .kp-footer {
                text-align: center;
            }

            .kp-footer .container {
                justify-content: center !important;
            }

            .table-responsive {
                border-radius: 12px;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg kp-nav" data-bs-theme="dark">
        <div class="container">

            <a class="kp-brand" href="{{ route('home') }}">Cari<span>Kos.</span></a>

            <button class="navbar-toggler border-0" type="button"
                    data-bs-toggle="collapse" data-bs-target="#kpNav"
                    aria-controls="kpNav" aria-expanded="false" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="kpNav">

                <ul class="navbar-nav me-auto ms-lg-4 gap-lg-1 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('home')) active @endif"
                           href="{{ route('home') }}">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('kos.*')) active @endif"
                           href="{{ route('kos.index') }}">Cari Kos</a>
                    </li>
                </ul>

                <div class="d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center gap-2 mt-3 mt-lg-0">

                    @auth
                        <div class="dropdown">
                            <button class="kp-user" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="kp-avatar">{{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
                                <span>{{ auth()->user()->name }}</span>
                                <i class="bi bi-chevron-down small"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person me-2"></i>Profil
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a class="kp-nav-ghost" href="{{ route('login') }}">Masuk</a>
                        <a class="kp-nav-cta" href="{{ route('register') }}">Daftar</a>
                    @endauth

                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="kp-footer">
        <div class="container d-flex flex-wrap justify-content-between gap-2">
            <span><strong>CariKos</strong> &copy; {{ date('Y') }}</span>
            <span>Rating bersumber dari Google Maps. Konfirmasi harga dan ketersediaan langsung ke pemilik kos.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
