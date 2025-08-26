<div class="add-to-cart-component" x-data="{ isAdding: false }" 
     @cart-item-added.window="isAdding = false">
    @if($mode === 'compact')
        {{-- Compact mode for product cards --}}
        <div class="flex flex-col sm:flex-row gap-2 items-stretch">
            {{-- Quantity selector --}}
            <div class="flex items-center justify-center bg-muted rounded-lg px-1 py-1 min-w-0 flex-shrink-0 gap-1 transition-all duration-300 hover:bg-muted/80">
                <x-strata::button 
                    wire:click="decrementQuantity"
                    variant="ghost"
                    size="sm"
                    icon="heroicon-m-minus"
                    class="!w-5 !h-5 !p-1 !text-xs !rounded-full transition-all duration-300 hover:scale-110"
                    x-bind:disabled="$wire.quantity <= 1"
                    x-bind:class="$wire.quantity <= 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-destructive hover:text-white'"
                    aria-label="Decrease quantity"
                />
                
                <span class="mx-1 text-xs font-semibold min-w-[1rem] text-center transition-all duration-300" 
                      x-text="$wire.quantity">{{ $this->quantity }}</span>
                
                <x-strata::button 
                    wire:click="incrementQuantity"
                    variant="ghost"
                    size="sm"
                    icon="heroicon-m-plus"
                    class="!w-5 !h-5 !p-1 !text-xs hover:bg-primary hover:text-white !rounded-full transition-all duration-300 hover:scale-110"
                    x-bind:disabled="$wire.quantity >= 99"
                    aria-label="Increase quantity"
                />
            </div>
            
            {{-- Add to cart button --}}
            <x-strata::button
                wire:click="addToCart"
                variant="primary"
                size="sm"
                class="flex-1 min-w-0 transition-all duration-300 hover:shadow-lg !py-2 !px-3"
                x-bind:class="isAdding ? 'animate-pulse' : ''"
                icon="heroicon-o-shopping-cart"
                @click="isAdding = true"
            >
                <span x-show="!isAdding">أضف للسلة</span>
                <span x-show="isAdding" class="flex items-center gap-1">
                    <div class="animate-spin rounded-full h-3 w-3 border-b-2 border-white"></div>
                    جارٍ الإضافة...
                </span>
            </x-strata::button>
        </div>
    @else
        {{-- Full mode for product pages --}}
        <div class="space-y-4">
            {{-- Quantity and Add to Cart - Inline Layout --}}
            <div class="flex items-center gap-4">
                {{-- Quantity selector with label --}}
                <div class="flex items-center gap-3">
                    <label class="text-sm font-semibold arabic-text text-foreground whitespace-nowrap">الكمية:</label>
                    <div class="flex items-center bg-muted rounded-lg p-1 gap-1">
                        <x-strata::button 
                            wire:click="decrementQuantity"
                            variant="ghost"
                            size="sm"
                            icon="heroicon-m-minus"
                            class="!w-6 !h-6 !p-1"
                            x-bind:disabled="$wire.quantity <= 1"
                            x-bind:class="$wire.quantity <= 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-destructive hover:text-white'"
                            aria-label="Decrease quantity"
                        />
                        
                        <input 
                            type="number" 
                            wire:model.live="quantity"
                            min="1" 
                            max="99"
                            class="w-12 h-6 text-center border-0 bg-transparent focus:ring-0 focus:outline-none text-sm font-semibold [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                        />
                        
                        <x-strata::button 
                            wire:click="incrementQuantity"
                            variant="ghost"
                            size="sm"
                            icon="heroicon-m-plus"
                            class="!w-6 !h-6 !p-1 hover:bg-primary hover:text-white"
                            x-bind:disabled="$wire.quantity >= 99"
                            aria-label="Increase quantity"
                        />
                    </div>
                </div>
                
                {{-- Add to cart button - now inline --}}
                <x-strata::button
                    wire:click="addToCart"
                    variant="primary"
                    size="md"
                    class="flex-1 transition-all duration-300 hover:scale-105 hover:shadow-lg active:scale-95"
                    x-bind:class="isAdding ? 'animate-pulse' : ''"
                    icon="heroicon-o-shopping-cart"
                    @click="isAdding = true"
                >
                    <span x-show="!isAdding">أضف للسلة</span>
                    <span x-show="isAdding" class="flex items-center gap-2">
                        <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                        جارٍ الإضافة...
                    </span>
                </x-strata::button>
            </div>
        </div>
    @endif

    {{-- Error message --}}
    @error('quantity')
        <div class="text-destructive text-xs mt-1 arabic-text">{{ $message }}</div>
    @enderror

    {{-- Toast notification at bottom center --}}
    <div 
        x-data="{ show: false }" 
        @cart-item-added.window="show = true; setTimeout(() => show = false, 2000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="fixed bottom-6 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded-lg shadow-lg bg-green-500 text-white arabic-text text-sm font-medium"
        style="display: none;"
    >
        <div class="flex items-center gap-2">
            <x-icon name="heroicon-o-check-circle" class="w-5 h-5" />
            <span>تم إضافة المنتج للسلة بنجاح</span>
        </div>
    </div>

</div>