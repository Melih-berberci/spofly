<?php

use App\Http\Controllers\DiscountController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DiscountController::class, 'index'])->name('discounts.index');
Route::get('/indirim/{slug}', [DiscountController::class, 'show'])->name('discounts.show');
