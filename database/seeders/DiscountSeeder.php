<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        $discounts = [
            [
                'name' => 'Apple iPhone 15 Pro Max 256GB',
                'category' => 'Elektronik',
                'description' => 'A17 Pro çip, titanium tasarım, 48MP ana kamera sistemi ile en gelişmiş iPhone deneyimi.',
                'original_price' => 74999.00,
                'discounted_price' => 64999.00,
                'image' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=500',
            ],
            [
                'name' => 'Samsung 65" QLED 4K Smart TV',
                'category' => 'Elektronik',
                'description' => 'Quantum Dot teknolojisi ile milyarlarca renk ve nefes kesici görüntü kalitesi.',
                'original_price' => 45999.00,
                'discounted_price' => 34999.00,
                'image' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=500',
            ],
            [
                'name' => 'Nike Air Max 270 Spor Ayakkabı',
                'category' => 'Giyim',
                'description' => 'Max Air ünitesi ile üstün konfor ve şık tasarım bir arada.',
                'original_price' => 4299.00,
                'discounted_price' => 2899.00,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500',
            ],
            [
                'name' => 'Dyson V15 Detect Kablosuz Süpürge',
                'category' => 'Ev & Yaşam',
                'description' => 'Lazer toz algılama ve LCD ekran ile akıllı temizlik deneyimi.',
                'original_price' => 29999.00,
                'discounted_price' => 22999.00,
                'image' => 'https://images.unsplash.com/photo-1558317374-067fb5f30001?w=500',
            ],
            [
                'name' => 'Sony WH-1000XM5 Kulaklık',
                'category' => 'Elektronik',
                'description' => 'Sınıfının en iyi gürültü engelleme özelliği ve 30 saat pil ömrü.',
                'original_price' => 12999.00,
                'discounted_price' => 9499.00,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500',
            ],
            [
                'name' => 'Adidas Ultraboost Light Koşu Ayakkabısı',
                'category' => 'Giyim',
                'description' => 'BOOST teknolojisi ile enerji dönüşümü ve hafif yapı.',
                'original_price' => 5499.00,
                'discounted_price' => 3999.00,
                'image' => 'https://images.unsplash.com/photo-1556048219-bb6978360b84?w=500',
            ],
            [
                'name' => 'De\'Longhi Magnifica Kahve Makinesi',
                'category' => 'Ev & Yaşam',
                'description' => 'Otomatik espresso ve cappuccino hazırlama, entegre öğütücü.',
                'original_price' => 24999.00,
                'discounted_price' => 17999.00,
                'image' => 'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=500',
            ],
            [
                'name' => 'Apple MacBook Air M3 256GB',
                'category' => 'Elektronik',
                'description' => 'M3 çip ile inanılmaz performans, 18 saate kadar pil ömrü.',
                'original_price' => 54999.00,
                'discounted_price' => 47999.00,
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500',
            ],
            [
                'name' => 'Levi\'s 501 Original Fit Jean',
                'category' => 'Giyim',
                'description' => 'Klasik kesim, %100 pamuk, zamansız stil.',
                'original_price' => 2499.00,
                'discounted_price' => 1699.00,
                'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=500',
            ],
            [
                'name' => 'Philips Airfryer XXL Premium',
                'category' => 'Ev & Yaşam',
                'description' => '7.3L kapasite, yağsız kızartma teknolojisi, akıllı sensör.',
                'original_price' => 8999.00,
                'discounted_price' => 5999.00,
                'image' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=500',
            ],
            [
                'name' => 'JBL Charge 5 Bluetooth Hoparlör',
                'category' => 'Elektronik',
                'description' => 'IP67 su geçirmez, 20 saat çalma süresi, powerbank özelliği.',
                'original_price' => 4999.00,
                'discounted_price' => 3499.00,
                'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=500',
            ],
            [
                'name' => 'The North Face Thermoball Eco Mont',
                'category' => 'Giyim',
                'description' => 'Geri dönüştürülmüş malzemeler, hafif ısı yalıtımı.',
                'original_price' => 6999.00,
                'discounted_price' => 4899.00,
                'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=500',
            ],
        ];

        foreach ($discounts as $discount) {
            $originalPrice = $discount['original_price'];
            $discountedPrice = $discount['discounted_price'];
            $percentage = (int) round((($originalPrice - $discountedPrice) / $originalPrice) * 100);

            Discount::create([
                'name' => $discount['name'],
                'slug' => Str::slug($discount['name']),
                'description' => $discount['description'],
                'image' => $discount['image'],
                'category' => $discount['category'],
                'original_price' => $originalPrice,
                'discounted_price' => $discountedPrice,
                'discount_percentage' => $percentage,
                'starts_at' => now()->subDays(rand(1, 3)),
                'ends_at' => now()->addDays(rand(3, 7)),
                'is_active' => true,
            ]);
        }
    }
}
