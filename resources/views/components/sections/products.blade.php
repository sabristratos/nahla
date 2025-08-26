@props([
    'products' => collect(),
    'title' => 'منتجاتنا الطبيعية',
    'subtitle' => 'اكتشف مجموعة متنوعة من المنتجات الطبيعية عالية الجودة للعناية بجمالك وصحة بشرتك',
    'showAll' => true,
    'maxProducts' => 8,
])

<div id="products-section" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-16" x-reveal="{ direction: 'up', duration: 0.8 }">
            <h2 class="text-4xl lg:text-5xl font-bold arabic-heading text-foreground mb-6">
                {{ $title }}
            </h2>
            <p class="text-lg text-muted-foreground arabic-text max-w-3xl mx-auto leading-relaxed">
                {{ $subtitle }}
            </p>

            {{-- Decorative line --}}
            <div class="flex items-center justify-center mt-8">
                <div class="h-px bg-gradient-to-r from-transparent via-primary to-transparent w-32"></div>
                <div class="mx-4 w-2 h-2 bg-primary rounded-full"></div>
                <div class="h-px bg-gradient-to-r from-primary via-accent to-transparent w-32"></div>
            </div>
        </div>

        {{-- Products Grid --}}
        @if($products->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" x-reveal="{ direction: 'up', delay: 0.2, stagger: 0.1 }">
                @foreach($products->take(4) as $index => $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            {{-- View All Products Button --}}
            <div class="text-center mt-16">
                <x-strata::button
                    variant="outline"
                    size="lg"
                    icon="heroicon-o-squares-2x2"
                    class="px-12 py-4"
                    href="{{ route('products.index') }}"
                >
                    عرض جميع المنتجات ({{ $products->count() }})
                </x-strata::button>
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-16" x-reveal="{ direction: 'up' }">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 mx-auto mb-6 bg-muted rounded-full flex items-center justify-center">
                        <x-icon name="heroicon-o-cube" class="w-12 h-12 text-muted-foreground" />
                    </div>
                    <h3 class="text-xl font-semibold text-foreground mb-3 arabic-text">
                        لا توجد منتجات متاحة حالياً
                    </h3>
                    <p class="text-muted-foreground arabic-text mb-6">
                        نحن نعمل على إضافة منتجات جديدة قريباً
                    </p>
                    <x-strata::button variant="primary">
                        تواصل معنا
                    </x-strata::button>
                </div>
            </div>
        @endif

        {{-- Background decorative elements --}}
        <div class="absolute top-1/4 left-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-1/4 right-10 w-40 h-40 bg-accent/5 rounded-full blur-3xl -z-10"></div>
    </div>
</div>

