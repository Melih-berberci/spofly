<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiscountController extends Controller
{
    /**
     * Haftalık indirimler sayfasını göster
     */
    public function index(Request $request): View
    {
        $category = $request->query('category', 'all');
        
        // Aktif kategorileri al (sadece aktif indirimlerdeki kategoriler)
        $categories = Discount::active()
            ->select('category')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();

        // İndirimleri getir (tarihi geçmiş olanları otomatik filtrele)
        $discounts = Discount::active()
            ->byCategory($category)
            ->orderBy('discount_percentage', 'desc')
            ->get();

        return view('discounts.index', [
            'discounts' => $discounts,
            'categories' => $categories,
            'selectedCategory' => $category,
            'pageTitle' => 'Haftanın İndirimleri',
            'pageDescription' => 'En güncel indirimler ve kampanyalar. Kaçırmayın!',
        ]);
    }

    /**
     * İndirim detay sayfası
     */
    public function show(string $slug): View
    {
        $discount = Discount::active()
            ->where('slug', $slug)
            ->firstOrFail();

        // Benzer ürünler (aynı kategoriden)
        $relatedDiscounts = Discount::active()
            ->where('category', $discount->category)
            ->where('id', '!=', $discount->id)
            ->limit(4)
            ->get();

        return view('discounts.show', [
            'discount' => $discount,
            'relatedDiscounts' => $relatedDiscounts,
        ]);
    }
}
