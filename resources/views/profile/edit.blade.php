
@extends('layouts.main')

@section('title', 'Pengaturan Akun - CariKos')

@section('content')
<style>
    .account-page {
        background: var(--kp-mist);
        min-height: 80vh;
        padding: 45px 0 60px;
    }

    .account-hero {
        background: linear-gradient(120deg, var(--kp-primary-dark), var(--kp-primary-hover));
        color: white;
        padding: 32px;
        border-radius: 18px;
        margin-bottom: 32px;
        box-shadow: 0 8px 22px rgba(37, 99, 235, .15);
    }

    .account-hero h2 {
        font-size: 27px;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .account-hero p {
        color: #fff;
        opacity: 1;
        font-size: 15px;
        font-weight: 500;
        margin: 0;
    }

    .section-heading {
        color: var(--kp-navy);
        font-size: 21px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .section-description {
        color: var(--kp-ink);
        font-size: 15px;
        font-weight: 500;
        line-height: 1.6;
        margin-bottom: 22px;
    }

    .account-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 15px;
        padding: 27px;
        margin-bottom: 22px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, .035);
    }

    .account-card h5 {
        color: var(--kp-navy);
        font-weight: 750;
        font-size: 18px;
        margin-bottom: 7px;
    }

    .account-card .card-description {
        color: var(--kp-ink);
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 22px;
    }

    .account-icon {
        width: 43px;
        height: 43px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--kp-primary-light);
        color: var(--kp-primary-dark);
        font-size: 20px;
        flex-shrink: 0;
    }

    .account-card-danger {
        border-color: #f5d5d5;
    }

    .account-card-danger .account-icon {
        background: #fff0f0;
        color: #dc3545;
    }

    @media(max-width: 576px) {
        .account-page {
            padding: 25px 0 40px;
        }

        .account-hero {
            padding: 24px;
        }

        .account-hero h2 {
            font-size: 23px;
        }

        .account-card {
            padding: 20px;
        }
    }
</style>

<div class="account-page">
    <div class="container">

        <div class="account-hero">
            <h2><i class="bi bi-person-gear me-2"></i>Pengaturan Akun</h2>
            <p>Kelola informasi pribadi dan keamanan akun CariKos Anda.</p>
        </div>

        <div class="mb-4">
            <h4 class="section-heading">Profil Saya</h4>
            <p class="section-description">
                Perbarui informasi akun agar selalu sesuai dengan data terbaru.
            </p>
        </div>

        <div class="account-card">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="account-icon">
                    <i class="bi bi-person-vcard"></i>
                </div>
                <div>
                    <h5 class="mb-1">Informasi Profil</h5>
                    <p class="card-description mb-0">
                        Perbarui nama dan alamat email akun Anda.
                    </p>
                </div>
            </div>

            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="account-card">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="account-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div>
                    <h5 class="mb-1">Keamanan Akun</h5>
                    <p class="card-description mb-0">
                        Gunakan kata sandi yang kuat untuk melindungi akun Anda.
                    </p>
                </div>
            </div>

            @include('profile.partials.update-password-form')
        </div>

        <div class="account-card account-card-danger">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="account-icon">
                    <i class="bi bi-trash3"></i>
                </div>
                <div>
                    <h5 class="mb-1">Hapus Akun</h5>
                    <p class="card-description mb-0">
                        Kelola penghapusan akun CariKos Anda.
                    </p>
                </div>
            </div>

            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>
@endsection
