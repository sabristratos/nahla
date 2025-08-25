<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        $products = Product::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('livewire.header', [
            'products' => $products
        ]);
    }
}
