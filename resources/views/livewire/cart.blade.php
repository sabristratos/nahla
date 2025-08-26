<div>
    <div class="fixed bottom-6 right-6 z-40 ">
    <x-strata::button
        wire:click="toggleCart"
        variant="primary"
        size="lg"
        data-cart-toggle
        class="shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110"
        icon="heroicon-o-shopping-bag"
        aria-label="Open shopping cart"
    >
    </x-strata::button>
    {{-- Item Count Badge --}}
    @if($this->itemCount > 0)
        <span class="absolute -top-2 -right-2 bg-accent text-white text-xs font-bold rounded-full min-w-[1.5rem] h-6 flex items-center justify-center px-1">
                {{ $this->itemCount }}
            </span>
    @endif
    </div>

    {{-- Floating Cart Panel --}}
    @if($isOpen)
        <div class="fixed inset-0 z-50" wire:transition.opacity>
            {{-- Background Overlay --}}
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                wire:click="closeCart"
            ></div>

            {{-- Cart Panel --}}
            <div class="absolute top-0 right-0 h-full w-full max-w-md bg-background border-l border-border shadow-2xl"
                 wire:transition.scale.origin.right.duration.300ms>
                {{-- Header --}}
                <div class="flex items-center justify-between p-4 border-b border-border bg-card">
                    <h2 class="text-xl font-bold arabic-text">سلة التسوق</h2>
                    <x-strata::button
                        wire:click="closeCart"
                        variant="ghost"
                        size="sm"
                        icon="heroicon-o-x-mark"
                        aria-label="Close cart"
                    />
                </div>

                {{-- Cart Items or Empty State --}}
                @if($this->hasItems)
                    <div class="flex-1 overflow-y-auto p-4 space-y-4 h-[calc(100vh-180px)]" wire:transition.opacity.delay.100ms>
                        @foreach($items as $item)
                            <div class="flex items-center gap-4 p-3 bg-card rounded-lg border border-border" wire:key="cart-item-{{ $item['id'] }}" @click.stop="">
                                {{-- Product Image --}}
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-muted flex-shrink-0">
                                    @if($item['image_path'])
                                        <img
                                            src="{{ asset('storage/' . $item['image_path']) }}"
                                            alt="{{ $item['name_ar'] }}"
                                            class="w-full h-full object-cover"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <x-icon name="heroicon-o-photo" class="w-6 h-6 text-muted-foreground" />
                                        </div>
                                    @endif
                                </div>

                                {{-- Product Info --}}
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-sm arabic-text text-foreground truncate">
                                        {{ $item['name_ar'] }}
                                    </h4>
                                    @if($item['size'])
                                        <p class="text-xs text-muted-foreground arabic-text">
                                            {{ $item['size'] }}
                                        </p>
                                    @endif
                                    <p class="text-sm font-semibold text-primary">
                                        {{ number_format($item['price'], 2) }} د.ت
                                    </p>
                                </div>

                                {{-- Quantity Controls --}}
                                <div class="flex items-center gap-2">
                                    <x-strata::button
                                        wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})"
                                        variant="ghost"
                                        size="sm"
                                        icon="heroicon-o-minus"
                                        aria-label="Decrease quantity"
                                        @click.stop=""
                                    />

                                    <span class="min-w-[2rem] text-center text-sm font-medium">{{ $item['quantity'] }}</span>

                                    <x-strata::button
                                        wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})"
                                        variant="ghost"
                                        size="sm"
                                        icon="heroicon-o-plus"
                                        aria-label="Increase quantity"
                                        @click.stop=""
                                    />
                                </div>

                                {{-- Remove Button --}}
                                <x-strata::button
                                    wire:click="removeItem({{ $item['id'] }})"
                                    variant="ghost"
                                    size="sm"
                                    icon="heroicon-o-trash"
                                    class="text-destructive hover:bg-destructive/10"
                                    aria-label="Remove item"
                                    @click.stop=""
                                />
                            </div>
                        @endforeach
                    </div>

                    {{-- Footer with Total and Actions --}}
                    <div class="border-t border-border bg-card p-4 space-y-4" wire:transition.opacity.delay.150ms>
                        {{-- Total --}}
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-semibold arabic-text">المجموع:</span>
                            <span class="text-xl font-bold text-primary">{{ $this->formattedTotal }}</span>
                        </div>

                        {{-- Actions --}}
                        <div class="space-y-2">
                            {{-- Checkout Button --}}
                            <x-strata::button
                                variant="primary"
                                size="lg"
                                class="w-full"
                                href="/checkout"
                                wire:click="closeCart"
                                icon="heroicon-o-credit-card"
                                iconPosition="right"
                            >
                                إتمام الطلب
                            </x-strata::button>

                            {{-- Clear Cart --}}
                            <x-strata::button
                                variant="destructive"
                                size="sm"
                                class="w-full"
                                wire:click="clearCart"
                                wire:confirm="هل أنت متأكد من إفراغ السلة؟"
                                icon="heroicon-o-trash"
                                iconPosition="right"
                            >
                                إفراغ السلة
                            </x-strata::button>
                        </div>
                    </div>
                @else
                    {{-- Empty Cart State --}}
                    <div class="flex-1 flex items-center justify-center p-8" wire:transition.scale.duration.200ms>
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto mb-4 bg-muted rounded-full flex items-center justify-center">
                                <x-icon name="heroicon-o-shopping-bag" class="w-10 h-10 text-muted-foreground" />
                            </div>
                            <h3 class="text-lg font-medium arabic-text text-foreground mb-2 text-center">
                                السلة فارغة
                            </h3>
                            <p class="text-muted-foreground arabic-text mb-4 text-center">
                                أضف منتجات لبدء التسوق
                            </p>
                            <x-strata::button
                                variant="primary"
                                href="/#products-section"
                                wire:click="closeCart"
                            >
                                تصفح المنتجات
                            </x-strata::button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    {{-- Success Messages --}}
    @if(session('cart-message'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            x-init="setTimeout(() => show = false, 3000)"
            class="fixed bottom-6 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded-lg shadow-lg bg-primary text-white arabic-text font-medium"
        >
            {{ session('cart-message') }}
        </div>
    @endif
</div>
