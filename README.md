# Spofly - Haftalık İndirimler

Modern, mobil öncelikli (mobile-first) haftalık indirim/kampanya sayfası. Laravel Blade ile geliştirilmiştir.

## 🎯 Özellikler

- **Mobile-First Tasarım**: Mobilde tek sütun, tablet/desktop'ta 2-3 sütun grid
- **Kategori Filtreleme**: Ürünleri kategoriye göre filtreleme
- **Otomatik Tarih Kontrolü**: Süresi geçmiş indirimler otomatik gizlenir
- **SEO Uyumlu**: Schema.org yapılandırılmış veri ve semantik HTML
- **Modern UI**: Yuvarlatılmış köşeler, yumuşak gölgeler, animasyonlar
- **Responsive**: Tüm ekran boyutlarına uyumlu

## 🚀 Hızlı Başlangıç

### Demo Önizleme (Laravel gerektirmez)

```bash
cd public
python3 -m http.server 8000
# veya
npx serve .
```

Tarayıcıda açın: `http://localhost:8000/demo.html`

### Laravel Kurulumu

```bash
# Bağımlılıkları yükle
composer install

# Environment dosyasını oluştur
cp .env.example .env

# Uygulama anahtarı oluştur
php artisan key:generate

# SQLite veritabanı oluştur
touch database/database.sqlite

# Migration çalıştır
php artisan migrate

# Örnek verileri ekle
php artisan db:seed

# Sunucuyu başlat
php artisan serve
```

## 📁 Proje Yapısı

```
spofly/
├── app/
│   ├── Http/Controllers/
│   │   └── DiscountController.php    # Ana controller
│   ├── Models/
│   │   └── Discount.php              # Discount model
│   └── Providers/
├── config/
├── database/
│   ├── migrations/                   # Veritabanı migration
│   └── seeders/
│       └── DiscountSeeder.php        # Örnek veriler
├── public/
│   ├── demo.html                     # Standalone demo
│   └── index.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php             # Ana layout
│   └── discounts/
│       ├── index.blade.php           # Liste sayfası
│       └── show.blade.php            # Detay sayfası
└── routes/
    └── web.php                       # Route tanımları
```

## 🎨 Tasarım

- **Renk Paleti**: Beyaz arka plan, kırmızı (#dc2626) vurgu rengi
- **Tipografi**: System font stack
- **CSS Framework**: Tailwind CSS (CDN)
- **İkonlar**: Inline SVG

## 📱 Responsive Breakpoints

| Ekran | Grid Sütunları |
|-------|----------------|
| Mobile (<640px) | 1 sütun |
| Tablet (640-1024px) | 2 sütun |
| Desktop (>1024px) | 3 sütun |

## 🔧 Özelleştirme

### Yeni Kategori Ekleme

`DiscountSeeder.php` dosyasında yeni ürünler ekleyebilirsiniz:

```php
[
    'name' => 'Ürün Adı',
    'category' => 'Yeni Kategori',
    'original_price' => 1000.00,
    'discounted_price' => 800.00,
    // ...
]
```

### Renk Değişikliği

`layouts/app.blade.php` dosyasında Tailwind config'i güncelleyin:

```javascript
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#your-color',
            }
        }
    }
}
```

## 📄 Lisans

MIT License
