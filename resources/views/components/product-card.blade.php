@props([
    'product' => null,
    'animated' => true,
])

<div class="group p-2 relative bg-card border border-border rounded-2xl overflow-visible shadow-lg hover:shadow-2xl transition-all duration-500 h-full flex flex-col"
     x-data="{ isHovered: false, isLoading: false }"
     @mouseenter="isHovered = true"
     @mouseleave="isHovered = false"
     @cart-item-added.window="isLoading = false">

    {{-- Product Image --}}
    <div class="aspect-square bg-muted overflow-hidden relative !rounded-[0.7rem]">
        @if($product && $product->image_path)
            <img
                src="{{ asset('storage/' . $product->image_path) }}"
                alt="{{ $product->name_ar }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
            >
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-muted to-muted/50">
                <x-icon name="heroicon-o-photo" class="w-16 h-16 text-muted-foreground" />
            </div>
        @endif

        {{-- Overlay on hover --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        {{-- Quick action badge --}}
        @if($product && $product->is_featured)
            <div class="absolute top-3 right-3 bg-primary text-primary-foreground px-3 py-1 rounded-full text-xs font-medium arabic-text shadow-lg animate-pulse">
                مميز
            </div>
        @endif
        
        {{-- Loading overlay --}}
        <div class="absolute inset-0 bg-white/80 opacity-0 flex items-center justify-center transition-opacity duration-300"
             :class="isLoading ? 'opacity-100' : 'opacity-0 pointer-events-none'">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
        </div>
    </div>

    {{-- Product Info --}}
    <div class="p-4 sm:p-6 relative flex-1 flex flex-col">
        {{-- Title and Price (Always visible) --}}
        <div class="mb-3">
            @if($product)
                <a href="{{ route('product.show', $product) }}" class="block group-title">
                    <h3 class="font-bold text-base arabic-text text-foreground leading-tight mb-2 hover:text-primary transition-all duration-300 cursor-pointer transform hover:scale-[1.02]">
                        {{ $product->name_ar ?? 'اسم المنتج' }}
                    </h3>
                </a>
            @else
                <h3 class="font-bold text-base arabic-text text-foreground leading-tight mb-2">
                    اسم المنتج
                </h3>
            @endif
            @if($product && $product->price)
                <p class="text-xl font-bold text-primary">
                    {{ number_format($product->price, 2) }} د.ت
                </p>
            @endif
        </div>

        {{-- Description and Add to Cart --}}
        <div class="flex-1 flex flex-col space-y-3">
            {{-- Description --}}
            <div class="md:transition-opacity md:duration-300"
                 :class="isHovered && window.innerWidth >= 768 ? 'md:opacity-50' : 'md:opacity-100'">
                <p class="text-sm text-muted-foreground arabic-text line-clamp-3">
                    {{ $product->description_ar ?? 'وصف قصير للمنتج يظهر المكونات والفوائد الطبيعية' }}
                </p>
            </div>

            {{-- Add to Cart Section --}}
            <div class="mt-auto space-y-3">
                @if($product && $product->size)
                    <p class="text-xs text-muted-foreground arabic-text">
                        {{ $product->size }}
                    </p>
                @endif
                @if($product)
                    <div @click="isLoading = true" 
                         class="md:transition-all md:duration-300 md:transform"
                         :class="isHovered && window.innerWidth >= 768 ? 'md:scale-105 md:shadow-lg' : ''">
                        <livewire:add-to-cart-button :product="$product" mode="compact" wire:key="cart-btn-{{ $product->id }}" />
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Hover glow effect --}}
    <div class="absolute -inset-0.5 bg-gradient-to-r from-primary/20 to-accent/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10 blur-sm"></div>
</div>
