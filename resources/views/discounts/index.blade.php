@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <section class="mb-6">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">{{ $pageTitle }}</h2>
        <p class="text-gray-600">{{ $pageDescription }}</p>
    </section>

    <!-- Category Filter -->
    @if($categories->isNotEmpty())
    <section class="mb-6 overflow-x-auto pb-2" aria-label="Kategori filtreleri">
        <div class="flex gap-2 min-w-max">
            <a href="{{ route('discounts.index') }}" 
               class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition-colors
                      {{ $selectedCategory === 'all' ? 'active bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                Tümü
            </a>
            @foreach($categories as $category)
                <a href="{{ route('discounts.index', ['category' => $category]) }}" 
                   class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition-colors whitespace-nowrap
                          {{ $selectedCategory === $category ? 'active bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                    {{ $category }}
                </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Discounts Grid -->
    @if($discounts->isEmpty())
        <div class="bg-white rounded-2xl p-8 text-center shadow-sm">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">İndirim Bulunamadı</h3>
            <p class="text-gray-500">Şu anda aktif indirim bulunmamaktadır. Daha sonra tekrar kontrol edin.</p>
        </div>
    @else
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6" aria-label="İndirimli ürünler">
            @foreach($discounts as $discount)
                <article class="discount-card bg-white rounded-2xl shadow-sm hover:shadow-lg overflow-hidden" itemscope itemtype="https://schema.org/Product">
                    <!-- Product Image -->
                    <div class="relative aspect-square bg-gray-100">
                        @if($discount->image)
                            <img src="{{ $discount->image }}" 
                                 alt="{{ $discount->name }}" 
                                 class="w-full h-full object-cover"
                                 loading="lazy"
                                 itemprop="image">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Discount Badge -->
                        <span class="discount-badge absolute top-3 left-3 bg-primary text-white text-sm font-bold px-3 py-1 rounded-full shadow-md">
                            %{{ $discount->discount_percentage }} İNDİRİM
                        </span>
                        
                        <!-- Remaining Time Badge -->
                        <span class="absolute top-3 right-3 bg-black/70 text-white text-xs px-2 py-1 rounded-full">
                            {{ $discount->remaining_time }}
                        </span>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-4">
                        <!-- Category -->
                        <span class="text-xs text-gray-500 uppercase tracking-wide">{{ $discount->category }}</span>
                        
                        <!-- Product Name -->
                        <h3 class="font-semibold text-gray-900 mt-1 mb-3 line-clamp-2" itemprop="name">
                            {{ $discount->name }}
                        </h3>
                        
                        <!-- Prices -->
                        <div class="flex items-center gap-3 mb-4" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                            <span class="old-price text-gray-400 text-sm">
                                {{ number_format($discount->original_price, 2, ',', '.') }} ₺
                            </span>
                            <span class="text-primary text-xl font-bold" itemprop="price" content="{{ $discount->discounted_price }}">
                                {{ number_format($discount->discounted_price, 2, ',', '.') }} ₺
                            </span>
                            <meta itemprop="priceCurrency" content="TRY">
                            <meta itemprop="availability" content="https://schema.org/InStock">
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('discounts.show', $discount->slug) }}" 
                               class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 text-center py-3 rounded-xl font-medium transition-colors">
                                İncele
                            </a>
                            <button type="button" 
                                    class="flex-1 bg-primary hover:bg-primary-dark text-white py-3 rounded-xl font-medium transition-colors"
                                    onclick="addToCart({{ $discount->id }})">
                                Sepete Ekle
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
        
        <!-- Results Count -->
        <p class="text-center text-gray-500 text-sm mt-6">
            {{ $discounts->count() }} indirimli ürün listeleniyor
        </p>
    @endif
@endsection

@push('scripts')
<script>
    function addToCart(productId) {
        // Sepete ekleme işlemi - gerçek uygulamada AJAX ile yapılır
        const btn = event.target;
        const originalText = btn.innerText;
        
        btn.disabled = true;
        btn.innerText = 'Eklendi ✓';
        btn.classList.remove('bg-primary', 'hover:bg-primary-dark');
        btn.classList.add('bg-green-500');
        
        setTimeout(() => {
            btn.disabled = false;
            btn.innerText = originalText;
            btn.classList.remove('bg-green-500');
            btn.classList.add('bg-primary', 'hover:bg-primary-dark');
        }, 2000);
        
        // TODO: Gerçek sepet işlemi
        console.log('Ürün sepete eklendi:', productId);
    }
</script>
@endpush
