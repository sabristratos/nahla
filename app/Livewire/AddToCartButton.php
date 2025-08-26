<?php

namespace App\Livewire;

use Livewire\Component;

class AddToCartButton extends Component
{
    public $product;

    public int $quantity = 1;

    public string $mode = 'compact'; // compact, full

    protected $rules = [
        'quantity' => 'required|integer|min:1|max:99',
    ];

    public function mount($product, $mode = 'compact')
    {
        $this->product = $product;
        $this->mode = $mode;
    }

    public function updatedQuantity()
    {
        $this->validateOnly('quantity');
    }

    public function incrementQuantity()
    {
        if ($this->quantity < 99) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $this->validate();

        if (! $this->product) {
            return;
        }

        // Convert product to array if it's a model
        $productData = is_array($this->product) ? $this->product : $this->product->toArray();

        // Dispatch event to Cart component
        $this->dispatch('add-to-cart', $productData, $this->quantity);

        // Open cart automatically after adding item
        $this->dispatch('open-cart');

        // Trigger success state for buttons via browser event
        $this->js('window.dispatchEvent(new CustomEvent("cart-item-added"));');

        // Reset quantity after adding
        $this->quantity = 1;
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
