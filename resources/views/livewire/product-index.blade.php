<div>
    {{-- Page Header --}}
    <div wire:ignore>
        <x-page-header
            title="جميع منتجاتنا الطبيعية"
            subtitle="استكشف مجموعتنا الكاملة من المنتجات الطبيعية عالية الجودة للعناية بجمالك وصحة بشرتك"
            :breadcrumbs="[
                ['title' => 'الرئيسية', 'url' => route('home')],
                ['title' => 'المنتجات', 'url' => null]
            ]"
        />
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">

            {{-- Mobile Filter Button --}}
            <div class="lg:hidden mb-6">
                <x-strata::button
                    variant="outline"
                    class="w-full"
                    x-data
                    @click="$dispatch('open-filters')"
                    icon="heroicon-o-adjustments-horizontal"
                >
                    <span class="arabic-text">فلترة المنتجات</span>
                </x-strata::button>
            </div>

            {{-- Sidebar Filters --}}
            <div class="hidden lg:block lg:col-span-1">
                <div class="sticky top-8">
                    <x-sections.product-filters
                        :search="$search"
                        :minPrice="$minPrice"
                        :maxPrice="$maxPrice"
                        :minPriceAvailable="$minPriceAvailable"
                        :maxPriceAvailable="$maxPriceAvailable"
                        :sortBy="$sortBy"
                        :sortDirection="$sortDirection"
                        :showInactive="$showInactive"
                    />
                </div>
            </div>

            {{-- Main Content --}}
            <div class="lg:col-span-3">
                {{-- Results Header --}}
                <div class="flex isolate flex-col z-50 sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div>
                        <p class="text-muted-foreground arabic-text">
                            @if($products->total() > 0)
                                عرض {{ $products->firstItem() }} - {{ $products->lastItem() }} من {{ $products->total() }} منتج
                            @else
                                لا توجد منتجات
                            @endif
                        </p>
                        @if($search || $minPrice || $maxPrice)
                            <x-strata::button
                                variant="ghost"
                                size="sm"
                                wire:click="clearFilters"
                                class="text-primary hover:text-primary/80 mt-1 p-0"
                            >
                                مسح جميع الفلاتر
                            </x-strata::button>
                        @endif
                    </div>

                    {{-- Custom Sort Dropdown --}}
                    <div class="mt-4 sm:mt-0 relative" x-data="{ 
                        open: false, 
                        selected: @entangle('sortOption')
                    }">
                        <button
                            x-ref="trigger"
                            @click="open = !open"
                            @click.outside="open = false"
                            type="button"
                            class="min-w-[220px] bg-card/80 backdrop-blur-sm border border-border/50 rounded-xl px-4 py-3 text-right arabic-text text-sm font-medium text-foreground shadow-sm hover:shadow-md hover:border-primary/30 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/50 transition-all duration-300 flex items-center justify-between group"
                        >
                            <span class="flex-1 text-right">
                                <template x-if="selected === 'sort_order-asc'">
                                    <span>الافتراضي</span>
                                </template>
                                <template x-if="selected === 'name_ar-asc'">
                                    <span>الاسم (أ - ي)</span>
                                </template>
                                <template x-if="selected === 'name_ar-desc'">
                                    <span>الاسم (ي - أ)</span>
                                </template>
                                <template x-if="selected === 'price-asc'">
                                    <span>السعر (الأقل أولاً)</span>
                                </template>
                                <template x-if="selected === 'price-desc'">
                                    <span>السعر (الأعلى أولاً)</span>
                                </template>
                                <template x-if="selected === 'created_at-desc'">
                                    <span>الأحدث أولاً</span>
                                </template>
                                <template x-if="!selected">
                                    <span class="text-muted-foreground">اختر طريقة الترتيب</span>
                                </template>
                            </span>
                            <x-icons.filter class="w-4 h-4 text-muted-foreground group-hover:text-primary transition-colors transition-transform duration-300 transform" x-bind:class="open ? 'rotate-180' : ''" />
                        </button>

                        <!-- Anchored Dropdown Menu -->
                        <template x-teleport="body">
                            <div
                                x-show="open"
                                x-anchor.bottom-start.offset.8="$refs.trigger"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95 translate-y-[-10px]"
                                x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 transform scale-95 translate-y-[-10px]"
                                class="bg-card/95 backdrop-blur-xl border border-border/50 rounded-xl shadow-xl overflow-hidden z-[9999] min-w-[220px]"
                                style="display: none;"
                            >
                                <div class="py-2">
                                    <button
                                        @click="$wire.set('sortOption', 'sort_order-asc'); selected = 'sort_order-asc'; open = false"
                                        class="w-full px-4 py-3 text-right arabic-text text-sm hover:bg-primary/10 hover:text-primary transition-all duration-200 flex items-center justify-between group"
                                        x-bind:class="selected === 'sort_order-asc' ? 'bg-primary/10 text-primary font-medium' : 'text-foreground'"
                                    >
                                        <span>الافتراضي</span>
                                        <x-icons.snow class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200" x-bind:class="selected === 'sort_order-asc' ? 'opacity-100' : ''" />
                                    </button>
                                    <button
                                        @click="$wire.set('sortOption', 'name_ar-asc'); selected = 'name_ar-asc'; open = false"
                                        class="w-full px-4 py-3 text-right arabic-text text-sm hover:bg-primary/10 hover:text-primary transition-all duration-200 flex items-center justify-between group"
                                        x-bind:class="selected === 'name_ar-asc' ? 'bg-primary/10 text-primary font-medium' : 'text-foreground'"
                                    >
                                        <span>الاسم (أ - ي)</span>
                                        <x-icons.leaf class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200" x-bind:class="selected === 'name_ar-asc' ? 'opacity-100' : ''" />
                                    </button>
                                    <button
                                        @click="$wire.set('sortOption', 'name_ar-desc'); selected = 'name_ar-desc'; open = false"
                                        class="w-full px-4 py-3 text-right arabic-text text-sm hover:bg-primary/10 hover:text-primary transition-all duration-200 flex items-center justify-between group"
                                        x-bind:class="selected === 'name_ar-desc' ? 'bg-primary/10 text-primary font-medium' : 'text-foreground'"
                                    >
                                        <span>الاسم (ي - أ)</span>
                                        <x-icons.leaf class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rotate-180" x-bind:class="selected === 'name_ar-desc' ? 'opacity-100' : ''" />
                                    </button>
                                    <button
                                        @click="$wire.set('sortOption', 'price-asc'); selected = 'price-asc'; open = false"
                                        class="w-full px-4 py-3 text-right arabic-text text-sm hover:bg-primary/10 hover:text-primary transition-all duration-200 flex items-center justify-between group"
                                        x-bind:class="selected === 'price-asc' ? 'bg-primary/10 text-primary font-medium' : 'text-foreground'"
                                    >
                                        <span>السعر (الأقل أولاً)</span>
                                        <span class="text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-200" x-bind:class="selected === 'price-asc' ? 'opacity-100' : ''">↓</span>
                                    </button>
                                    <button
                                        @click="$wire.set('sortOption', 'price-desc'); selected = 'price-desc'; open = false"
                                        class="w-full px-4 py-3 text-right arabic-text text-sm hover:bg-primary/10 hover:text-primary transition-all duration-200 flex items-center justify-between group"
                                        x-bind:class="selected === 'price-desc' ? 'bg-primary/10 text-primary font-medium' : 'text-foreground'"
                                    >
                                        <span>السعر (الأعلى أولاً)</span>
                                        <span class="text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-200" x-bind:class="selected === 'price-desc' ? 'opacity-100' : ''">↑</span>
                                    </button>
                                    <button
                                        @click="$wire.set('sortOption', 'created_at-desc'); selected = 'created_at-desc'; open = false"
                                        class="w-full px-4 py-3 text-right arabic-text text-sm hover:bg-primary/10 hover:text-primary transition-all duration-200 flex items-center justify-between group"
                                        x-bind:class="selected === 'created_at-desc' ? 'bg-primary/10 text-primary font-medium' : 'text-foreground'"
                                    >
                                        <span>الأحدث أولاً</span>
                                        <x-icons.snow class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200" x-bind:class="selected === 'created_at-desc' ? 'opacity-100' : ''" />
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Loading State --}}
                @if($isLoading)
                <div class="mb-8">
                    <div class="flex items-center gap-2 text-muted-foreground">
                        <div class="animate-spin rounded-full h-4 w-4 border-2 border-primary border-t-transparent"></div>
                        <span class="arabic-text">جاري التحميل...</span>
                    </div>
                </div>

                {{-- Skeleton Loader --}}
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @for($i = 0; $i < 6; $i++)
                        <div class="animate-pulse">
                            <div class="bg-muted rounded-2xl p-6">
                                <div class="aspect-square bg-muted-foreground/20 rounded-xl mb-4"></div>
                                <div class="h-4 bg-muted-foreground/20 rounded mb-2"></div>
                                <div class="h-4 bg-muted-foreground/20 rounded w-3/4 mb-3"></div>
                                <div class="h-6 bg-muted-foreground/20 rounded w-1/2"></div>
                            </div>
                        </div>
                    @endfor
                </div>
                @else
                {{-- Products Grid --}}
                <div>
                    @if($products->count() > 0)
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-12">
                            @foreach($products as $product)
                                <div wire:key="product-index-{{ $product->id }}">
                                    <x-product-card :product="$product" />
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-12">
                            {{ $products->links() }}
                        </div>
                    @else
                    {{-- Empty State --}}
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 mx-auto mb-6 bg-muted rounded-full flex items-center justify-center">
                                <x-icons.filter class="w-12 h-12 text-muted-foreground" />
                            </div>
                            <h3 class="text-xl font-semibold text-foreground mb-3 arabic-text">
                                لم نجد أي منتجات
                            </h3>
                            <p class="text-muted-foreground arabic-text mb-6">
                                @if($search || $minPrice || $maxPrice)
                                    جرب تعديل معايير البحث أو مسح الفلاتر
                                @else
                                    لا توجد منتجات متاحة حالياً
                                @endif
                            </p>
                            @if($search || $minPrice || $maxPrice)
                                <x-strata::button wire:click="clearFilters" variant="primary">
                                    مسح جميع الفلاتر
                                </x-strata::button>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Mobile Filter Modal --}}
    <div
        x-data="{ open: false }"
        @open-filters.window="open = true"
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="lg:hidden fixed inset-0 z-50 overflow-y-auto"
        style="display: none;"
    >
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            {{-- Backdrop --}}
            <div
                @click="open = false"
                class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"
            ></div>

            {{-- Modal --}}
            <div
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-card rounded-t-2xl px-4 pt-5 pb-4 text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 sm:rounded-2xl"
            >
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold arabic-text">فلترة المنتجات</h3>
                    <x-strata::button
                        variant="ghost"
                        @click="open = false"
                        class="text-muted-foreground hover:text-foreground"
                        aria-label="Close filters"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </x-strata::button>
                </div>

                <x-sections.product-filters
                    :search="$search"
                    :minPrice="$minPrice"
                    :maxPrice="$maxPrice"
                    :minPriceAvailable="$minPriceAvailable"
                    :maxPriceAvailable="$maxPriceAvailable"
                    :sortBy="$sortBy"
                    :sortDirection="$sortDirection"
                    :showInactive="$showInactive"
                    mobile="true"
                />

                <div class="mt-6 flex gap-3">
                    <x-strata::button @click="open = false" variant="outline" class="flex-1">
                        إغلاق
                    </x-strata::button>
                    <x-strata::button wire:click="clearFilters" variant="primary" class="flex-1">
                        مسح الفلاتر
                    </x-strata::button>
                </div>
            </div>
        </div>
    </div>

    {{-- Background decorative elements --}}
    <div class="fixed top-1/4 left-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl -z-10"></div>
    <div class="fixed bottom-1/4 right-10 w-40 h-40 bg-accent/5 rounded-full blur-3xl -z-10"></div>
</div>
