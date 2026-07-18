<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MediaVerse') }} - Auth</title>

    <!-- Fonts & Bootstrap 5 CDN -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Efek latar belakang Cinematic Blur khusus form Auth */
        body {
            background: radial-gradient(circle at top center, #1F2833 0%, #0B0C10 70%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .auth-card {
            background-color: var(--mv-surface);
            border: 1px solid var(--mv-border);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-5">
                <!-- Logo -->
                <div class="text-center mb-4">
                    <a href="/" class="text-decoration-none text-white fs-1 fw-bold">
                        <span class="text-gold" style="color: var(--mv-accent-gold);">Media</span>Verse
                    </a>
                </div>
                
                <!-- Box Form Login/Register ($slot) -->
                <div class="auth-card p-4 p-md-5">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>