<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public bool $isOpen = false;

    public array $items = [];

    public function mount()
    {
        $this->loadCartFromSession();
    }

    #[On('open-cart')]
    public function openCart()
    {
        $this->isOpen = true;
    }

    #[On('add-to-cart')]
    public function addProductToCart($productData, $quantity = 1)
    {
        if (empty($productData) || ! isset($productData['id'])) {
            return;
        }

        $productId = $productData['id'];
        $existingItemIndex = $this->findItemIndex($productId);

        if ($existingItemIndex !== false) {
            // Update quantity of existing item
            $this->items[$existingItemIndex]['quantity'] += (int) $quantity;
        } else {
            // Add new item
            $this->items[] = [
                'id' => $productData['id'],
                'name_ar' => $productData['name_ar'],
                'price' => (float) $productData['price'],
                'size' => $productData['size'] ?? '',
                'image_path' => $productData['image_path'] ?? '',
                'quantity' => (int) $quantity,
            ];
        }

        $this->saveCartToSession();
        $this->dispatch('cart-updated');

        // Show success message
        session()->flash('cart-message', "تم إضافة {$productData['name_ar']} للسلة");
    }

    public function removeItem($productId)
    {
        $itemIndex = $this->findItemIndex($productId);

        if ($itemIndex !== false) {
            $itemName = $this->items[$itemIndex]['name_ar'];
            array_splice($this->items, $itemIndex, 1);
            $this->saveCartToSession();
            $this->dispatch('cart-updated');

            session()->flash('cart-message', "تم حذف {$itemName} من السلة");
        }
    }

    public function updateQuantity($productId, $newQuantity)
    {
        $itemIndex = $this->findItemIndex($productId);
        $quantity = (int) $newQuantity;

        if ($itemIndex !== false) {
            if ($quantity <= 0) {
                $this->removeItem($productId);
            } else {
                $this->items[$itemIndex]['quantity'] = $quantity;
                $this->saveCartToSession();
                $this->dispatch('cart-updated');
            }
        }
    }

    public function clearCart()
    {
        $this->items = [];
        $this->saveCartToSession();
        $this->dispatch('cart-updated');

        session()->flash('cart-message', 'تم إفراغ السلة');
    }

    public function toggleCart()
    {
        $this->isOpen = ! $this->isOpen;
    }

    public function closeCart()
    {
        $this->isOpen = false;
    }

    public function getItemCountProperty()
    {
        return array_sum(array_column($this->items, 'quantity'));
    }

    public function getTotalPriceProperty()
    {
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $this->items));
    }

    public function getFormattedTotalProperty()
    {
        return number_format($this->totalPrice, 2).' د.ت';
    }

    public function getHasItemsProperty()
    {
        return count($this->items) > 0;
    }

    private function findItemIndex($productId)
    {
        foreach ($this->items as $index => $item) {
            if ($item['id'] == $productId) {
                return $index;
            }
        }

        return false;
    }

    private function saveCartToSession()
    {
        session(['nahla_cart' => $this->items]);
    }

    private function loadCartFromSession()
    {
        $this->items = session('nahla_cart', []);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
