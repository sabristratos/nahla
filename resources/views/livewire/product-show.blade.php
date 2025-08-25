{{-- Product Show Page --}}
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb Navigation --}}
        <nav class="mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-muted-foreground">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-primary transition-colors arabic-text">
                        الرئيسية
                    </a>
                </li>
                <li>
                    <x-icon name="heroicon-o-chevron-left" class="w-4 h-4" />
                </li>
                <li>
                    <span class="arabic-text">المنتجات</span>
                </li>
                <li>
                    <x-icon name="heroicon-o-chevron-left" class="w-4 h-4" />
                </li>
                <li class="text-foreground arabic-text">
                    {{ $product->name_ar }}
                </li>
            </ol>
        </nav>

        {{-- Product Details --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Product Image --}}
            <div class="space-y-4">
                <div class="aspect-square bg-muted rounded-2xl overflow-hidden">
                    @if($product->image_path)
                        <img 
                            src="{{ asset('storage/' . $product->image_path) }}" 
                            alt="{{ $product->name_ar }}" 
                            class="w-full h-full object-cover"
                        >
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <x-icon name="heroicon-o-photo" class="w-24 h-24 text-muted-foreground" />
                        </div>
                    @endif
                </div>
                
                {{-- Additional Images Placeholder --}}
                <div class="grid grid-cols-4 gap-2">
                    @for($i = 0; $i < 4; $i++)
                        <div class="aspect-square bg-muted rounded-lg opacity-50">
                        </div>
                    @endfor
                </div>
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

                {{-- Contact for Order --}}
                <div class="bg-muted rounded-2xl p-6 space-y-4">
                    <h3 class="text-primary arabic-heading">
                        اطلب الآن
                    </h3>
                    <p class="text-primary arabic-text">
                        للطلب، يرجى الاتصال بنا على الأرقام التالية:
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="tel:21526011" 
                           class="flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-3 rounded-lg transition-colors arabic-text font-medium">
                            <x-icon name="heroicon-o-phone" class="w-5 h-5" />
                            21.526.011
                        </a>
                        <a href="tel:29082808" 
                           class="flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-3 rounded-lg transition-colors arabic-text font-medium">
                            <x-icon name="heroicon-o-phone" class="w-5 h-5" />
                            29.082.808
                        </a>
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
