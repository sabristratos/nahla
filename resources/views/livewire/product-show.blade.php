<div>
{{-- Product Show Page --}}
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Product Details --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Product Image --}}
            <div class="space-y-4" x-data="{
                imageZoomed: false,
                currentImage: @js($product->image_path ? asset('storage/' . $product->image_path) : ''),
                images: @js(collect([$product->image_path ? asset('storage/' . $product->image_path) : null])
                    ->concat(collect($product->additional_images ?? [])->map(fn($img) => asset('storage/' . $img)))
                    ->filter()
                    ->values()
                    ->toArray())
            }">
                <div class="aspect-square bg-muted rounded-2xl overflow-hidden relative group cursor-zoom-in"
                     @click="imageZoomed = !imageZoomed">
                    <template x-if="currentImage">
                        <img
                            :src="currentImage"
                            alt="{{ $product->name_ar }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            :class="imageZoomed ? 'scale-150' : 'scale-100'"
                            loading="lazy"
                        >
                    </template>

                    <template x-if="!currentImage">
                        <div class="w-full h-full flex items-center justify-center">
                            <x-icon name="heroicon-o-photo" class="w-24 h-24 text-muted-foreground" />
                        </div>
                    </template>

                    {{-- Zoom overlay indicator --}}
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <div class="bg-white/90 text-foreground px-3 py-2 rounded-lg text-sm font-medium flex items-center gap-2">
                            <x-icon name="heroicon-o-magnifying-glass-plus" class="w-4 h-4" />
                            <span>انقر للتكبير</span>
                        </div>
                    </div>
                </div>

                {{-- Image Thumbnails Gallery --}}
                @php
                    $hasImages = $product->image_path || ($product->additional_images && count($product->additional_images) > 0);
                    $totalImages = ($product->image_path ? 1 : 0) + (is_array($product->additional_images) ? count($product->additional_images) : 0);
                @endphp
                
                @if($totalImages > 1)
                    <div class="grid grid-cols-4 gap-2">
                        @if($product->image_path)
                            <div class="aspect-square bg-muted rounded-lg overflow-hidden cursor-pointer hover:ring-2 hover:ring-primary transition-all duration-300"
                                 @click="currentImage = '{{ asset('storage/' . $product->image_path) }}'"
                                 :class="currentImage === '{{ asset('storage/' . $product->image_path) }}' ? 'ring-2 ring-primary' : ''">
                                <img
                                    src="{{ asset('storage/' . $product->image_path) }}"
                                    alt="{{ $product->name_ar }}"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                    loading="lazy"
                                />
                            </div>
                        @endif

                        @if($product->additional_images && is_array($product->additional_images))
                            @foreach($product->additional_images as $index => $image)
                                <div class="aspect-square bg-muted rounded-lg overflow-hidden cursor-pointer hover:ring-2 hover:ring-primary transition-all duration-300"
                                     @click="currentImage = '{{ asset('storage/' . $image) }}'"
                                     :class="currentImage === '{{ asset('storage/' . $image) }}' ? 'ring-2 ring-primary' : ''">
                                    <img
                                        src="{{ asset('storage/' . $image) }}"
                                        alt="{{ $product->name_ar }} - صورة {{ $index + 1 }}"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    />
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif
            </div>

            {{-- Product Info --}}
            <div class="space-y-6">
                {{-- Product Title --}}
                <div>
                    <h1 class="arabic-heading mb-2">
                        {{ $product->name_ar }}
                    </h1>
                    @if($product->name_en)
                        <h2 class="text-muted-foreground">
                            {{ $product->name_en }}
                        </h2>
                    @endif
                </div>

                {{-- Price --}}
                @if($product->price)
                    <div class="text-3xl font-bold text-primary">
                        {{ number_format($product->price, 2) }} د.ت
                    </div>
                @endif

                {{-- Product Details --}}
                <div class="space-y-4">
                    @if($product->size)
                        <div class="flex items-center gap-3">
                            <x-icon name="heroicon-o-cube" class="w-5 h-5 text-muted-foreground" />
                            <span class="arabic-text">الحجم: {{ $product->size }}</span>
                        </div>
                    @endif

                    @if($product->category)
                        <div class="flex items-center gap-3">
                            <x-icon name="heroicon-o-tag" class="w-5 h-5 text-muted-foreground" />
                            <span class="arabic-text">الفئة: {{ $product->category }}</span>
                        </div>
                    @endif

                    @if($product->ingredients)
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <x-icon name="heroicon-o-list-bullet" class="w-5 h-5 text-muted-foreground" />
                                <span class="font-medium arabic-text">المكونات:</span>
                            </div>
                            <p class="text-muted-foreground arabic-text mr-8">
                                {{ $product->ingredients }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Product Description --}}
                @if($product->description_ar)
                    <div class="space-y-3">
                        <h3 class="arabic-heading">
                            الوصف
                        </h3>
                        <p class="text-muted-foreground arabic-text">
                            {{ $product->description_ar }}
                        </p>
                    </div>
                @endif

                {{-- Benefits --}}
                @if($product->benefits)
                    <div class="space-y-3">
                        <h3 class="arabic-heading">
                            الفوائد
                        </h3>
                        <p class="text-muted-foreground arabic-text">
                            {{ $product->benefits }}
                        </p>
                    </div>
                @endif

                {{-- Usage Instructions --}}
                @if($product->usage_instructions)
                    <div class="space-y-3">
                        <h3 class="arabic-heading">
                            طريقة الاستعمال
                        </h3>
                        <p class="text-muted-foreground arabic-text">
                            {{ $product->usage_instructions }}
                        </p>
                    </div>
                @endif

                {{-- Add to Cart Section --}}
                <div class="bg-muted rounded-2xl p-6 space-y-6">
                    <h3 class="text-primary arabic-heading">
                        اطلب الآن
                    </h3>

                    {{-- Add to Cart Component --}}
                    <livewire:add-to-cart-button :product="$product" mode="full" :key="'product-cart-'.$product->id" />

                    {{-- Alternative Contact Methods --}}
                    <div class="border-t border-border pt-4">
                        <p class="text-sm text-muted-foreground arabic-text mb-3">
                            أو تواصل معنا مباشرة:
                        </p>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <a href="tel:21526011"
                               class="flex items-center justify-center gap-2 bg-background hover:bg-primary hover:text-primary-foreground border border-primary text-primary px-4 py-2 rounded-lg transition-all duration-300 arabic-text text-sm">
                                <x-icon name="heroicon-o-phone" class="w-4 h-4" />
                                21.526.011
                            </a>
                            <a href="tel:29082808"
                               class="flex items-center justify-center gap-2 bg-background hover:bg-primary hover:text-primary-foreground border border-primary text-primary px-4 py-2 rounded-lg transition-all duration-300 arabic-text text-sm">
                                <x-icon name="heroicon-o-phone" class="w-4 h-4" />
                                29.082.808
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Back to Home --}}
        <div class="mt-12 text-center">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 text-primary hover:text-primary/80 transition-colors arabic-text font-medium">
                <x-icon name="heroicon-o-arrow-right" class="w-4 h-4" />
                العودة إلى الرئيسية
            </a>
        </div>
    </div>
</div>
</div>
