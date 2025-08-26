@props([
    'search' => '',
    'minPrice' => '',
    'maxPrice' => '',
    'minPriceAvailable' => 0,
    'maxPriceAvailable' => 100,
    'sortBy' => 'sort_order',
    'sortDirection' => 'asc',
    'showInactive' => false,
    'mobile' => false,
])

<div class="{{ $mobile ? '' : 'bg-card border border-border rounded-2xl p-4' }}">
    @if(!$mobile)
        <h3 class="text-lg font-semibold arabic-text text-foreground mb-6">فلترة المنتجات</h3>
    @endif

    <div class="space-y-6">
        {{-- Search --}}
        <div>
            <label class="block text-sm font-medium text-foreground arabic-text mb-2">
                البحث
            </label>
            <div class="relative">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="filters.search"
                    placeholder="البحث في المنتجات..."
                    class="w-full px-4 py-3 pr-10 bg-background border border-border rounded-xl text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-primary focus:border-transparent transition-all arabic-text @error('filters.search') border-red-500 @enderror"
                >
                @error('filters.search')
                    <p class="text-red-500 text-xs mt-1 arabic-text">{{ $message }}</p>
                @enderror
                <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <svg class="w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Price Range --}}
        <div>
            <label class="block text-sm font-medium text-foreground arabic-text mb-2">
                نطاق السعر
            </label>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="flex-1">
                        <label class="block text-xs text-muted-foreground arabic-text mb-1">من</label>
                        <input
                            type="number"
                            wire:model.live.debounce.500ms="filters.minPrice"
                            placeholder="{{ number_format($minPriceAvailable, 0) }}"
                            min="{{ $minPriceAvailable }}"
                            max="{{ $maxPriceAvailable }}"
                            step="0.01"
                            class="w-full px-3 py-2 bg-background border border-border rounded-lg text-sm text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('filters.minPrice') border-red-500 @enderror"
                        >
                        @error('filters.minPrice')
                            <p class="text-red-500 text-xs mt-1 arabic-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs text-muted-foreground arabic-text mb-1">إلى</label>
                        <input
                            type="number"
                            wire:model.live.debounce.500ms="filters.maxPrice"
                            placeholder="{{ number_format($maxPriceAvailable, 0) }}"
                            min="{{ $minPriceAvailable }}"
                            max="{{ $maxPriceAvailable }}"
                            step="0.01"
                            class="w-full px-3 py-2 bg-background border border-border rounded-lg text-sm text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('filters.maxPrice') border-red-500 @enderror"
                        >
                        @error('filters.maxPrice')
                            <p class="text-red-500 text-xs mt-1 arabic-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="text-xs text-muted-foreground arabic-text">
                    السعر بالدينار التونسي ({{ number_format($minPriceAvailable, 0) }} - {{ number_format($maxPriceAvailable, 0) }} د.ت)
                </div>
            </div>
        </div>

        {{-- Quick Price Filters --}}
        <div>
            <label class="block text-sm font-medium text-foreground arabic-text mb-3">
                فلاتر سريعة للسعر
            </label>
            <div class="grid grid-cols-2 gap-2">
                <x-strata::button
                    variant="outline"
                    size="sm"
                    wire:click="setPriceRange('', '25')"
                    :active="$maxPrice === '25' && $minPrice === ''"
                >
                    أقل من 25 د.ت
                </x-strata::button>
                <x-strata::button
                    variant="outline"
                    size="sm"
                    wire:click="setPriceRange('25', '50')"
                    :active="$minPrice === '25' && $maxPrice === '50'"
                >
                    25 - 50 د.ت
                </x-strata::button>
                <x-strata::button
                    variant="outline"
                    size="sm"
                    wire:click="setPriceRange('50', '100')"
                    :active="$minPrice === '50' && $maxPrice === '100'"
                >
                    50 - 100 د.ت
                </x-strata::button>
                <x-strata::button
                    variant="outline"
                    size="sm"
                    wire:click="setPriceRange('100', '')"
                    :active="$minPrice === '100' && $maxPrice === ''"
                >
                    أكثر من 100 د.ت
                </x-strata::button>
            </div>
        </div>

        {{-- Show Inactive Toggle --}}
        <div>
            <label class="flex items-center gap-3 cursor-pointer">
                <input
                    type="checkbox"
                    wire:model.live="filters.showInactive"
                    class="w-4 h-4 text-primary bg-background border border-border rounded focus:ring-2 focus:ring-primary"
                >
                <span class="text-sm text-foreground arabic-text">عرض المنتجات غير المتاحة</span>
            </label>
        </div>

        {{-- Active Filters Summary --}}
        @if($search || $minPrice || $maxPrice || $showInactive)
            <div class="pt-4 border-t border-border">
                <h4 class="text-sm font-medium text-foreground arabic-text mb-3">الفلاتر النشطة</h4>
                <div class="space-y-2">
                    @if($search)
                        <div class="flex items-center justify-between bg-primary/10 text-primary px-3 py-2 rounded-lg text-xs">
                            <span class="arabic-text">البحث: {{ $search }}</span>
                            <x-strata::button
                                variant="ghost"
                                size="sm"
                                wire:click="$set('filters.search', '')"
                                class="hover:text-primary/70 text-current"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </x-strata::button>
                        </div>
                    @endif

                    @if($minPrice || $maxPrice)
                        <div class="flex items-center justify-between bg-accent/10 text-accent px-3 py-2 rounded-lg text-xs">
                            <span class="arabic-text">
                                السعر:
                                @if($minPrice && $maxPrice)
                                    {{ $minPrice }} - {{ $maxPrice }} د.ت
                                @elseif($minPrice)
                                    من {{ $minPrice }} د.ت
                                @elseif($maxPrice)
                                    حتى {{ $maxPrice }} د.ت
                                @endif
                            </span>
                            <x-strata::button
                                variant="ghost"
                                size="sm"
                                wire:click="setPriceRange('', '')"
                                class="hover:text-accent/70 text-current"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </x-strata::button>
                        </div>
                    @endif

                    @if($showInactive)
                        <div class="flex items-center justify-between bg-muted text-muted-foreground px-3 py-2 rounded-lg text-xs">
                            <span class="arabic-text">عرض غير المتاح</span>
                            <x-strata::button
                                variant="ghost"
                                size="sm"
                                wire:click="$set('filters.showInactive', false)"
                                class="hover:opacity-70 text-current"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </x-strata::button>
                        </div>
                    @endif
                </div>

                <x-strata::button
                    variant="outline"
                    size="sm"
                    wire:click="clearFilters"
                    class="w-full mt-3 text-muted-foreground hover:text-foreground"
                >
                    مسح جميع الفلاتر
                </x-strata::button>
            </div>
        @endif
    </div>
</div>
