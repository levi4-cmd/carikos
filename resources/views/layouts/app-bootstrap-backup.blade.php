
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CariKos')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        
.hero-section {
    background: linear-gradient(120deg, #102c54, #245b91);
    padding: 85px 0;
}

.search-box {
    background: white;
    padding: 22px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
}

.feature-card {
    padding: 30px 20px;
    border-radius: 14px;
    background: white;
    height: 100%;
    box-shadow: 0 4px 18px rgba(0,0,0,0.04);
}

.feature-icon {
    font-size: 35px;
    color: #245b91;
    margin-bottom: 15px;
}

.kos-card {
    border: none;
    border-radius: 14px;
    overflow: hidden;
    transition: transform 0.2s;
}

.kos-card:hover {
    transform: translateY(-5px);
}

.kos-image {
    height: 220px;
    object-fit: cover;
}

.price {
    color: #1d65a6;
    font-weight: bold;
    font-size: 19px;
}

.about-section {
    background: #f0f5fa;
}

.footer-section {
    background: #102c54;
}

        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            color: #172554;
        }

        .navbar-brand {
            font-size: 25px;
            font-weight: bold;
            color: #173b70;
        }

        .hero {
            background: linear-gradient(120deg, #102c54, #245b91);
            color: white;
            padding: 85px 0;
        }

        .hero h1 {
            font-size: 44px;
            font-weight: bold;
        }

        .search-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-top: 30px;
        }

        .kos-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            transition: 0.2s;
        }

        .kos-card:hover {
            transform: translateY(-5px);
        }

        .kos-image {
            height: 200px;
            object-fit: cover;
        }

        .price {
            color: #1d65a6;
            font-weight: bold;
        }

        footer {
            background: #102c54;
            color: white;
            padding: 25px 0;
            margin-top: 70px;
        }
    </style>

    @stack('styles')
</head>
<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
