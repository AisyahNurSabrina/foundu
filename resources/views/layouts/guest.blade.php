<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FoundU') — Lost & Found Kampus</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: linear-gradient(135deg, #0c0e30 0%, #1a1040 25%, #2d1b69 50%, #1a1040 75%, #0c0e30 100%); min-height: 100vh; position: relative; overflow-x: hidden;">
    {{-- Animated background orbs --}}
    <div style="position: fixed; top: -20%; right: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%); border-radius: 50%; animation: floatOrb 8s ease-in-out infinite; pointer-events: none;"></div>
    <div style="position: fixed; bottom: -20%; left: -10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(96, 165, 250, 0.12) 0%, transparent 70%); border-radius: 50%; animation: floatOrb 10s ease-in-out infinite reverse; pointer-events: none;"></div>
    <div style="position: fixed; top: 40%; left: 50%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(244, 114, 182, 0.08) 0%, transparent 70%); border-radius: 50%; animation: floatOrb 12s ease-in-out infinite; pointer-events: none;"></div>

    <div class="container" style="position: relative; z-index: 1;">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-5 col-lg-4">
                <div class="text-center mb-4 fade-in-up">
                    <a href="/" class="text-decoration-none">
                        <h1 class="fw-bold mb-2" style="font-size: 2.5rem; letter-spacing: 3px; background: linear-gradient(135deg, #a78bfa, #60a5fa, #34d399); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            <i class="bi bi-search-heart me-2" style="-webkit-text-fill-color: #a78bfa;"></i>FoundU
                        </h1>
                        <p style="color: rgba(255,255,255,0.5); letter-spacing: 1px;">Platform Lost & Found Kampus</p>
                    </a>
                </div>
                <div class="card border-0 fade-in-up" style="border-radius: 24px; backdrop-filter: blur(20px); background: rgba(255,255,255,0.95); box-shadow: 0 24px 80px rgba(0,0,0,0.3), 0 0 60px rgba(102, 126, 234, 0.1);">
                    <div class="card-body p-4 p-md-5">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes floatOrb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(20px, -20px) scale(1.1); }
        }
    </style>
</body>
</html>
