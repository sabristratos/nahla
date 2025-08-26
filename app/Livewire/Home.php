<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Review;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Home extends Component
{
    public function render()
    {
        // Use cached methods for better performance
        $featuredProducts = Product::getCachedFeatured(2);
        $products = Product::getCachedActive();
        $featuredTestimonials = Review::getCachedFeatured();
        $castorOilProduct = Product::getCachedCastorOil();

        return view('livewire.home', [
            'featuredProducts' => $featuredProducts,
            'products' => $products,
            'featuredTestimonials' => $featuredTestimonials,
            'castorOilProduct' => $castorOilProduct,
        ]);
    }
}
