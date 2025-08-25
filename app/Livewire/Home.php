<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Home extends Component
{
    public function render()
    {
        $featuredProducts = Product::where('is_active', true)
            ->orderBy('sort_order')
            ->take(2)
            ->get();

        return view('livewire.home', [
            'featuredProducts' => $featuredProducts
        ]);
    }
}
