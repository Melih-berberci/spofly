<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes, viewport-fit=cover">
    <meta name="description" content="{{ $pageDescription ?? 'Haftalık indirimler ve kampanyalar' }}">
    <meta name="keywords" content="indirim, kampanya, haftalık indirimler, fırsat">
    <meta name="robots" content="index, follow">
    
    <!-- Mobile App Meta Tags -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Spofly">
    <meta name="format-detection" content="telephone=no">
    <meta name="theme-color" content="#ffffff">
    
    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="{{ $pageTitle ?? 'Haftanın İndirimleri' }}">
    <meta property="og:description" content="{{ $pageDescription ?? 'En güncel indirimler ve kampanyalar' }}">
    <meta property="og:type" content="website">
    
    <title>{{ $pageTitle ?? 'Haftanın İndirimleri' }} | Spofly</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#dc2626',
                        'primary-dark': '#b91c1c',
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Styles -->
    <style>
        /* Base Reset & Mobile Optimization */
        *, *::before, *::after {
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }
        
        html {
            scroll-behavior: smooth;
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }
        
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            touch-action: manipulation;
            overscroll-behavior-y: contain;
            min-height: 100vh;
            min-height: -webkit-fill-available;
        }
        
        @supports (-webkit-touch-callout: none) {
            body { min-height: -webkit-fill-available; }
        }
        
        /* Safe Area Support */
        .safe-area-top { padding-top: env(safe-area-inset-top, 0px); }
        .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom, 0px); }
        .safe-area-left { padding-left: env(safe-area-inset-left, 0px); }
        .safe-area-right { padding-right: env(safe-area-inset-right, 0px); }
        
        /* Card Interactions */
        .discount-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
        }
        
        @media (hover: hover) and (pointer: fine) {
            .discount-card:hover { transform: translateY(-4px); }
        }
        
        .discount-card:active { transform: scale(0.98); }
        
        /* Old Price */
        .old-price { position: relative; }
        .old-price::after {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 2px;
            background: #9ca3af;
        }
        
        /* Filter Buttons */
        .filter-btn { -webkit-user-select: none; user-select: none; }
        .filter-btn.active { background-color: #dc2626; color: white; }
        .filter-btn:active { transform: scale(0.95); }
        
        /* Discount Badge */
        @keyframes pulse-discount {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .discount-badge { animation: pulse-discount 2s infinite; }
        
        /* Touch-friendly */
        button, .btn { min-height: 44px; min-width: 44px; cursor: pointer; }
        
        /* Hide scrollbar */
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        
        /* Small screens */
        @media (max-width: 375px) {
            .text-xl { font-size: 1.125rem; }
            .p-4 { padding: 0.75rem; }
            .discount-badge { font-size: 0.75rem; padding: 0.25rem 0.5rem; }
        }
        
        /* Landscape phones */
        @media (max-height: 500px) and (orientation: landscape) {
            .sticky { position: relative; }
        }
        
        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen safe-area-top safe-area-bottom safe-area-left safe-area-right">
    <!-- Fixed Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('discounts.index') }}" class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/>
                    </svg>
                    <h1 class="text-xl font-bold text-gray-900">Spofly</h1>
                </a>
                <span class="text-sm text-gray-500">{{ now()->format('d M Y') }}</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} Spofly. Tüm hakları saklıdır.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
