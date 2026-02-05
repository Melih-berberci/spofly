@extends('layouts.app')

@section('content')
    <!-- Back Button -->
    <a href="{{ route('discounts.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Geri Dön
    </a>

    <article class="bg-white rounded-2xl shadow-sm overflow-hidden" itemscope itemtype="https://schema.org/Product">
        <div class="md:flex">
            <!-- Product Image -->
            <div class="md:w-1/2 relative">
                <div class="aspect-square bg-gray-100">
                    @if($discount->image)
                        <img src="{{ $discount->image }}" 
                             alt="{{ $discount->name }}" 
                             class="w-full h-full object-cover"
                             itemprop="image">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-32 h-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <!-- Discount Badge -->
                <span class="discount-badge absolute top-4 left-4 bg-primary text-white text-lg font-bold px-4 py-2 rounded-full shadow-lg">
                    %{{ $discount->discount_percentage }} İNDİRİM
                </span>
            </div>
            
            <!-- Product Details -->
            <div class="md:w-1/2 p-6 md:p-8 flex flex-col">
                <!-- Category -->
                <span class="text-sm text-gray-500 uppercase tracking-wide mb-2">{{ $discount->category }}</span>
                
                <!-- Product Name -->
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4" itemprop="name">
                    {{ $discount->name }}
                </h1>
                
                <!-- Description -->
                @if($discount->description)
                    <p class="text-gray-600 mb-6" itemprop="description">
                        {{ $discount->description }}
                    </p>
                @endif
                
                <!-- Prices -->
                <div class="flex items-end gap-4 mb-6" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                    <div>
                        <span class="block text-sm text-gray-500 mb-1">Eski Fiyat</span>
                        <span class="old-price text-gray-400 text-xl">
                            {{ number_format($discount->original_price, 2, ',', '.') }} ₺
                        </span>
                    </div>
                    <div>
                        <span class="block text-sm text-primary mb-1">İndirimli Fiyat</span>
                        <span class="text-primary text-3xl font-bold" itemprop="price" content="{{ $discount->discounted_price }}">
                            {{ number_format($discount->discounted_price, 2, ',', '.') }} ₺
                        </span>
                    </div>
                    <meta itemprop="priceCurrency" content="TRY">
                    <meta itemprop="availability" content="https://schema.org/InStock">
                </div>
                
                <!-- Savings -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
                    <p class="text-green-700 font-medium">
                        💰 {{ number_format($discount->original_price - $discount->discounted_price, 2, ',', '.') }} ₺ tasarruf ediyorsunuz!
                    </p>
                </div>
                
                <!-- Time Remaining -->
                <div class="flex items-center gap-2 text-gray-600 mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $discount->remaining_time }}</span>
                </div>
                
                <!-- Add to Cart Button -->
                <div class="mt-auto">
                    <button type="button" 
                            class="w-full bg-primary hover:bg-primary-dark text-white py-4 rounded-xl font-semibold text-lg transition-colors"
                            onclick="addToCart({{ $discount->id }})">
                        Sepete Ekle
                    </button>
                </div>
            </div>
        </div>
    </article>

    <!-- Related Products -->
    @if($relatedDiscounts->isNotEmpty())
        <section class="mt-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Benzer Ürünler</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($relatedDiscounts as $related)
                    <a href="{{ route('discounts.show', $related->slug) }}" class="discount-card bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md">
                        <div class="aspect-square bg-gray-100 relative">
                            @if($related->image)
                                <img src="{{ $related->image }}" 
                                     alt="{{ $related->name }}" 
                                     class="w-full h-full object-cover"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <span class="absolute top-2 left-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">
                                %{{ $related->discount_percentage }}
                            </span>
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-gray-900 text-sm line-clamp-1">{{ $related->name }}</h3>
                            <span class="text-primary font-bold">{{ number_format($related->discounted_price, 2, ',', '.') }} ₺</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endsection

@push('scripts')
<script>
    function addToCart(productId) {
        const btn = event.target;
        const originalText = btn.innerText;
        
        btn.disabled = true;
        btn.innerText = 'Sepete Eklendi ✓';
        btn.classList.remove('bg-primary', 'hover:bg-primary-dark');
        btn.classList.add('bg-green-500');
        
        setTimeout(() => {
            btn.disabled = false;
            btn.innerText = originalText;
            btn.classList.remove('bg-green-500');
            btn.classList.add('bg-primary', 'hover:bg-primary-dark');
        }, 2000);
        
        console.log('Ürün sepete eklendi:', productId);
    }
</script>
@endpush
