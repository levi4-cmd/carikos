
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - CariKos</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #EFF6FF;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            color: #0F172A;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            background: #fff;
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 22px 65px rgba(15, 23, 42, .12);
        }

        .auth-left {
            background: linear-gradient(145deg, #2563EB, #1E3A8A 65%, #0F172A);
            color: white;
            padding: 48px 45px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .auth-left::before,
        .auth-left::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,.10);
            pointer-events: none;
        }

        .auth-left::before {
            width: 330px;
            height: 330px;
            right: -130px;
            top: -120px;
        }

        .auth-left::after {
            width: 260px;
            height: 260px;
            left: -120px;
            bottom: -100px;
        }

        .brand {
            position: relative;
            z-index: 1;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.7px;
            color: white;
            text-decoration: none;
        }

        .brand span {
            color: #DBEAFE;
        }

        .illustration {
            text-align: center;
            position: relative;
            z-index: 1;
            margin: 25px 0;
        }

        .illustration svg {
            width: 100%;
            max-width: 320px;
            height: auto;
            filter: drop-shadow(0 12px 15px rgba(15, 23, 42,.12));
        }

        .left-text {
            position: relative;
            z-index: 1;
        }

        .left-text .eyebrow {
            display: inline-block;
            background: rgba(255,255,255,.17);
            border: 1px solid rgba(255,255,255,.25);
            padding: 7px 13px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .left-text h1 {
            font-size: 30px;
            line-height: 1.3;
            margin-bottom: 15px;
            font-weight: 800;
        }

        .left-text p {
            color: #EFF6FF;
            line-height: 1.8;
            font-size: 14px;
            max-width: 390px;
        }

        .auth-right {
            padding: 65px 58px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome {
            margin-bottom: 32px;
        }

        .small-title {
            color: #2563EB;
            font-weight: 800;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1.7px;
            margin-bottom: 11px;
        }

        .welcome h2 {
            font-size: 31px;
            margin-bottom: 10px;
            color: #0F172A;
            font-weight: 800;
        }

        .welcome p {
            color: #64748B;
            font-size: 14px;
            line-height: 1.7;
        }

        .form-group {
            margin-bottom: 21px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 9px;
            color: #334155;
        }

        .form-group input {
            width: 100%;
            height: 51px;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 0 15px;
            font-size: 14px;
            outline: none;
            transition: .2s;
            background: #F8FAFC;
            color: #0F172A;
        }

        .form-group input:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 4px rgba(59,130,246,.12);
            background: white;
        }

        .form-group input::placeholder {
            color: #64748B;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #64748B;
        }

        .remember input {
            width: 16px;
            height: 16px;
            accent-color: #2563EB;
            cursor: pointer;
        }

        .remember label {
            cursor: pointer;
        }

        .auth-button {
            width: 100%;
            height: 51px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(110deg, #2563EB, #1D4ED8);
            color: white;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
            box-shadow: 0 7px 16px rgba(37,99,235,.18);
        }

        .auth-button:hover {
            background: linear-gradient(110deg, #1D4ED8, #1E3A8A);
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(37,99,235,.25);
        }

        .forgot {
            text-align: right;
            margin-top: 17px;
            font-size: 13px;
        }

        .forgot a,
        .auth-footer a {
            color: #2563EB;
            text-decoration: none;
            font-weight: 700;
        }

        .forgot a:hover,
        .auth-footer a:hover {
            text-decoration: underline;
        }

        .auth-footer {
            text-align: center;
            margin-top: 32px;
            padding-top: 22px;
            border-top: 1px solid #E2E8F0;
            color: #64748B;
            font-size: 13px;
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 7px;
        }

        .status-message {
            background: #ecfdf5;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px 14px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .auth-wrapper {
                grid-template-columns: 1fr;
                max-width: 480px;
                min-height: auto;
            }

            .auth-left {
                padding: 27px 28px;
                min-height: 245px;
            }

            .illustration {
                display: none;
            }

            .left-text {
                margin-top: 38px;
            }

            .left-text h1 {
                font-size: 24px;
            }

            .auth-right {
                padding: 38px 28px;
            }

            .welcome h2 {
                font-size: 27px;
            }
        }
    </style>
</head>

<body>

<div class="auth-wrapper">

    <div class="auth-left">
        <a href="{{ url('/') }}" class="brand">CariKos<span>.</span></a>

        <div class="illustration">
            <svg viewBox="0 0 340 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M55 112L170 45L285 112V220H55V112Z"
                      fill="#EFF6FF" fill-opacity=".20"
                      stroke="#EFF6FF" stroke-width="3"/>
                <path d="M35 117L170 35L305 117"
                      stroke="#EFF6FF" stroke-width="7"
                      stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="135" y="145" width="70" height="75"
                      rx="5" fill="#DBEAFE"/>
                <rect x="78" y="125" width="43" height="43"
                      rx="4" fill="#EFF6FF"/>
                <rect x="220" y="125" width="43" height="43"
                      rx="4" fill="#EFF6FF"/>
                <path d="M100 125V168M78 146H121M241 125V168M220 146H263"
                      stroke="#1D4ED8" stroke-width="3"/>
                <circle cx="191" cy="185" r="3" fill="#1D4ED8"/>
                <path d="M170 35V12H220V66"
                      stroke="#EFF6FF" stroke-width="4"
                      stroke-linejoin="round"/>
                <path d="M220 12H242" stroke="#EFF6FF" stroke-width="4"/>
            </svg>
        </div>

        <div class="left-text">
            <div class="eyebrow">Temukan Kos Lebih Mudah</div>
            <h1>Temukan tempat tinggal yang tepat untukmu.</h1>
            <p>
                Cari berbagai pilihan kos dengan informasi lokasi,
                fasilitas, dan detail tempat tinggal dalam satu platform.
            </p>
        </div>
    </div>

    <div class="auth-right">

        <div class="welcome">
            <div class="small-title">Selamat Datang Kembali</div>
            <h2>Masuk ke Akun</h2>
            <p>Silakan masuk untuk melanjutkan menggunakan layanan CariKos.</p>
        </div>

        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email Anda"
                    required
                    autofocus
                    autocomplete="username"
                >

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Masukkan kata sandi"
                    required
                    autocomplete="current-password"
                >

                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Ingat saya</label>
            </div>

            <button type="submit" class="auth-button">
                Masuk ke CariKos
            </button>

            @if (Route::has('password.request'))
                <div class="forgot">
                    <a href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                </div>
            @endif
        </form>

        <div class="auth-footer">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>

    </div>
</div>

</body>
</html>
