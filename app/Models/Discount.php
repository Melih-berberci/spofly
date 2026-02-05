<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category',
        'original_price',
        'discounted_price',
        'discount_percentage',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    protected $casts = [
        'original_price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'discount_percentage' => 'integer',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Scope: Sadece aktif ve süresi geçmemiş indirimleri getir
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where('starts_at', '<=', now())
            ->where('ends_at', '>=', now());
    }

    /**
     * Scope: Kategoriye göre filtrele
     */
    public function scopeByCategory(Builder $query, ?string $category): Builder
    {
        if ($category && $category !== 'all') {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * İndirim yüzdesini hesapla
     */
    public function calculateDiscountPercentage(): int
    {
        if ($this->original_price > 0) {
            return (int) round((($this->original_price - $this->discounted_price) / $this->original_price) * 100);
        }
        return 0;
    }

    /**
     * İndirim süresinin dolup dolmadığını kontrol et
     */
    public function isExpired(): bool
    {
        return $this->ends_at < now();
    }

    /**
     * İndirim başlayıp başlamadığını kontrol et
     */
    public function hasStarted(): bool
    {
        return $this->starts_at <= now();
    }

    /**
     * Kalan süreyi hesapla
     */
    public function getRemainingTimeAttribute(): string
    {
        if ($this->isExpired()) {
            return 'Sona erdi';
        }

        $diff = now()->diff($this->ends_at);
        
        if ($diff->days > 0) {
            return $diff->days . ' gün kaldı';
        } elseif ($diff->h > 0) {
            return $diff->h . ' saat kaldı';
        } else {
            return $diff->i . ' dakika kaldı';
        }
    }
}
