<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        // Get 1 featured product using cache
        $featuredProduct = Product::getCachedFeatured(1)->first();

        // Get 3 regular products (non-featured) using cache
        $regularProducts = Product::getCachedRegular(3);

        return view('livewire.header', [
            'featuredProduct' => $featuredProduct,
            'regularProducts' => $regularProducts
        ]);
    }
}
