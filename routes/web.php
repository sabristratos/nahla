<?php

use App\Livewire\Home;
use App\Livewire\ProductShow;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/product/{product}', ProductShow::class)->name('product.show');
