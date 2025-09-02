<div class="space-y-8">
    {{-- Main Heading --}}
    <div class="space-y-6" x-fade-in="{ stagger: 0.3, delay: 0.2 }">
        <h1 class="text-5xl lg:text-6xl font-bold arabic-heading leading-tight">
            <span class="bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                نهلة
            </span>
            <br>
            <span class="text-foreground">
                للجمال الطبيعي
            </span>
        </h1>

        <p class="text-xl text-muted-foreground arabic-text max-w-lg">
            منتجات طبيعية عالية الجودة للعناية بجمالك وصحة بشرتك، مصنوعة بحب من أجود المكونات الطبيعية
        </p>
    </div>

    {{-- CTA Buttons --}}
    <div class="flex flex-col sm:flex-row gap-4" x-scale-in="{ delay: 0.8, duration: 0.6 }">
        <x-strata::button 
            variant="primary" 
            data-animate="button"
            href="{{ route('products.index') }}"
        >
            اكتشف منتجاتنا
        </x-strata::button>
        <x-strata::button 
            variant="outline" 
            data-animate="button"
            @click="$dispatch('open-contact-modal')"
        >
            تعرف علينا أكثر
        </x-strata::button>
    </div>

    {{-- Social Proof --}}
    <div class="space-y-6 pt-8">
        <div x-slide-up="{ delay: 1.0 }">
            <x-social-proof />
        </div>

        {{-- Stats --}}
        <div x-reveal="{ direction: 'up', delay: 1.2 }">
            <x-stats-grid
                :stats="[
                    ['value' => '100%', 'label' => 'طبيعي'],
                    ['value' => '0%', 'label' => 'مواد كيماوية'],
                    ['value' => '24/7', 'label' => 'دعم العملاء']
                ]"
                :bordered="true"
            />
        </div>
    </div>
</div>
