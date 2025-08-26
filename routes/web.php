<?php

use App\Livewire\Checkout;
use App\Livewire\Home;
use App\Livewire\ProductIndex;
use App\Livewire\ProductShow;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/produits', ProductIndex::class)->name('products.index');
Route::get('/product/{product}', ProductShow::class)->name('product.show');
Route::get('/checkout', Checkout::class)->name('checkout');
