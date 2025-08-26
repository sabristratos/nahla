<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\OrderStatus;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Checkout extends Component
{
    #[Validate('required|string|max:255')]
    public string $customer_name = '';

    #[Validate('required|string|max:20')]
    public string $customer_phone = '';

    #[Validate('required|string|max:500')]
    public string $customer_address = '';

    #[Validate('required|email|max:255')]
    public string $customer_email = '';

    #[Validate('nullable|string|max:1000')]
    public string $notes = '';

    public array $cartItems = [];

    public bool $isProcessing = false;

    public bool $orderComplete = false;

    public function mount(): void
    {
        $this->cartItems = session('nahla_cart', []);

        if (empty($this->cartItems)) {
            $this->redirect('/', navigate: true);

            return;
        }
    }

    public function processCheckout(): void
    {
        if ($this->isProcessing) {
            return;
        }

        $this->isProcessing = true;

        try {
            $this->validate();

            if (empty($this->cartItems)) {
                throw ValidationException::withMessages([
                    'cart' => 'السلة فارغة',
                ]);
            }

            // Create orders for each cart item
            foreach ($this->cartItems as $item) {
                $product = Product::find($item['id']);

                if (! $product) {
                    continue;
                }

                Order::create([
                    'product_id' => $product->id,
                    'customer_name' => $this->customer_name,
                    'customer_phone' => $this->customer_phone,
                    'customer_address' => $this->customer_address,
                    'customer_email' => $this->customer_email,
                    'quantity' => $item['quantity'],
                    'total_amount' => $product->price * $item['quantity'],
                    'status' => OrderStatus::Pending,
                    'notes' => $this->notes,
                ]);
            }

            // Clear the cart
            session()->forget('nahla_cart');
            session()->flash('checkout-success', 'تم إرسال طلبك بنجاح! سنتواصل معك قريباً.');

            $this->orderComplete = true;
            $this->isProcessing = false;

        } catch (ValidationException $e) {
            $this->isProcessing = false;
            throw $e;
        } catch (\Exception $e) {
            $this->isProcessing = false;
            session()->flash('checkout-error', 'حدث خطأ أثناء معالجة طلبك. يرجى المحاولة مرة أخرى.');
        }
    }

    public function getCartTotalProperty(): float
    {
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $this->cartItems));
    }

    public function getFormattedCartTotalProperty(): string
    {
        return number_format($this->cartTotal, 2).' د.ت';
    }

    public function getItemCountProperty(): int
    {
        return array_sum(array_column($this->cartItems, 'quantity'));
    }

    public function redirectToHome(): void
    {
        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.checkout')
            ->layout('components.layouts.app')
            ->title('إتمام الطلب - نهلة للعناية الطبيعية');
    }
}
