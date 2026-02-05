<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $pageDescription ?? 'Haftalık indirimler ve kampanyalar' }}">
    <meta name="keywords" content="indirim, kampanya, haftalık indirimler, fırsat">
    <meta name="robots" content="index, follow">
    
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
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Mobile app feel */
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Card hover animation */
        .discount-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .discount-card:hover {
            transform: translateY(-4px);
        }
        
        /* Price strikethrough animation */
        .old-price {
            position: relative;
        }
        
        .old-price::after {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 2px;
            background: #9ca3af;
        }
        
        /* Filter button active state */
        .filter-btn.active {
            background-color: #dc2626;
            color: white;
        }
        
        /* Discount badge pulse */
        @keyframes pulse-discount {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .discount-badge {
            animation: pulse-discount 2s infinite;
        }
        
        /* Safe area for mobile devices */
        .safe-area-top {
            padding-top: env(safe-area-inset-top);
        }
        
        .safe-area-bottom {
            padding-bottom: env(safe-area-inset-bottom);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen safe-area-top safe-area-bottom">
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
