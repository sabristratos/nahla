@props([
    'title' => 'زيت الخروع',
    'subtitle' => 'غير مصفى طبيعي ٪100 معصور على البارد',
    'videoPath' => null,
    'imagePath' => 'products/castor-oil-2.png',
    'product' => null,
])

<div class="py-16 overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            {{-- Left Column - Product Info --}}
            <div class="space-y-8" x-reveal="{ direction: 'left', duration: 0.8 }">

                {{-- Product Title --}}
                <div class="space-y-4">
                    <h2 class="text-5xl lg:text-6xl font-bold arabic-heading text-foreground leading-tight">
                        {{ $title }}
                    </h2>
                    <p class="text-xl text-muted-foreground arabic-text leading-relaxed max-w-lg">
                        {{ $subtitle }}
                    </p>
                </div>

                {{-- Benefits with Icons --}}
                <div class="grid gap-6">

                    {{-- Unfiltered / Pure --}}
                    <div class="flex items-center gap-4" x-reveal="{ direction: 'left', delay: 0.2 }">
                        <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0 text-primary">
                            <x-icons.filter class="w-8 h-8" />
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg arabic-text text-foreground">غير مصفى</h3>
                            <p class="text-muted-foreground arabic-text">زيت خام نقي بدون معالجة</p>
                        </div>
                    </div>

                    {{-- 100% Natural --}}
                    <div class="flex items-center gap-4" x-reveal="{ direction: 'left', delay: 0.3 }">
                        <div class="w-14 h-14 bg-accent/10 rounded-xl flex items-center justify-center flex-shrink-0 text-accent">
                            <x-icons.leaf class="w-8 h-8" />
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg arabic-text text-foreground">طبيعي 100%</h3>
                            <p class="text-muted-foreground arabic-text">بدون إضافات أو مواد كيميائية</p>
                        </div>
                    </div>

                    {{-- Cold Pressed --}}
                    <div class="flex items-center gap-4" x-reveal="{ direction: 'left', delay: 0.4 }">
                        <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0 text-primary">
                            <x-icons.snow class="w-8 h-8" />
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg arabic-text text-foreground">معصور على البارد</h3>
                            <p class="text-muted-foreground arabic-text">يحافظ على جميع العناصر الغذائية</p>
                        </div>
                    </div>
                </div>

                {{-- Product Actions --}}
                @if($product)
                    <div class="space-y-4" x-reveal="{ direction: 'left', delay: 0.5 }">
                        {{-- Price Display --}}
                        <div class="flex items-center gap-3">
                            <span class="text-3xl font-bold text-primary">{{ number_format($product->price, 0) }} د.ت</span>
                            <span class="text-muted-foreground arabic-text">{{ $product->size }}</span>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-3">
                            {{-- Add to Cart Component --}}
                            <div class="flex-1">
                                <livewire:add-to-cart-button :product="$product" mode="full" />
                            </div>

                            {{-- Direct Order Button --}}
                            <x-strata::button
                                variant="outline"
                                size="lg"
                                class="px-6 py-3"
                                icon="heroicon-o-shopping-bag"
                                iconPosition="right"
                                @click="openQuickOrderModal({
                                    id: {{ $product->id }},
                                    name: '{{ $product->name_ar }}',
                                    price: {{ $product->price ?? 0 }},
                                    size: '{{ $product->size }}',
                                    image: '{{ $product->image_path ? asset('storage/' . $product->image_path) : '' }}'
                                })"
                            >
                                اطلب الآن
                            </x-strata::button>
                        </div>
                    </div>
                @else
                    {{-- Fallback CTA Button --}}
                    <div x-reveal="{ direction: 'left', delay: 0.5 }">
                        <x-strata::button
                            variant="primary"
                            size="lg"
                            class="px-8 py-4"
                            href="#products-section"
                        >
                            <x-icon name="heroicon-o-heart" class="w-5 h-5 ml-2" />
                            اكتشف المنتج
                        </x-strata::button>
                    </div>
                @endif

            </div>

            {{-- Right Column - Media Showcase --}}
            <div class="relative" x-reveal="{ direction: 'right', duration: 0.8 }">

                <div class="relative max-w-2xl mx-auto">
                    {{-- Main Product Image --}}
                    <div class="relative z-10" x-reveal="{ direction: 'up', delay: 0.2 }">
                        <div class="aspect-square bg-muted rounded-3xl overflow-hidden shadow-2xl max-w-lg mx-auto">
                            <img
                                src="{{ asset($imagePath) }}"
                                alt="{{ $title }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-700"
                            >
                        </div>
                    </div>

                    {{-- Video Reel (Floating) --}}
                    @if($videoPath)
                        <div class="absolute -top-12 -right-12 z-20" x-reveal="{ direction: 'right', delay: 0.4 }">
                            <div class="aspect-[9/16] w-48 bg-muted rounded-2xl overflow-hidden shadow-xl border-4 border-background">
                                <video
                                    class="w-full h-full object-cover"
                                    autoplay
                                    muted
                                    loop
                                    playsinline
                                    onError="this.style.display='none';"
                                >
                                    <source src="{{ asset($videoPath) }}" type="video/mp4">
                                </video>
                            </div>
                        </div>
                    @endif

                    {{-- Decorative Elements --}}
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-primary/10 rounded-full blur-xl -z-10"></div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-accent/10 rounded-full blur-xl -z-10"></div>
                </div>

            </div>

        </div>

        {{-- Background Decorative Elements --}}
        <div class="absolute top-1/4 left-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-1/4 right-10 w-40 h-40 bg-accent/5 rounded-full blur-3xl -z-10"></div>

    </div>
</div>
