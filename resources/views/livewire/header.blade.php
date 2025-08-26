<header class="backdrop-blur-sm sticky top-0 z-50 transition-all duration-300" 
        x-data="{ 
            mobileMenuOpen: false,
            init() {
                Alpine.store('mobileMenu', { open: false });
                this.$watch('mobileMenuOpen', value => Alpine.store('mobileMenu').open = value);
                this.$watch('$store.mobileMenu.open', value => this.mobileMenuOpen = value);
            }
        }">
    <div class="max-w-7xl py-6 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 items-center min-h-16" style="grid-template-columns: 1fr auto 1fr;">
            <!-- Left Column: Products Mega Menu (justify-start) -->
            <div class="flex items-center justify-start">
                <div class="hidden md:flex items-center">
                    <div
                        x-data="{ open: false }"
                        @click.away="open = false"
                    >
                        <x-strata::button
                            variant="ghost"
                            @click="open = !open"
                            x-ref="megaMenuTrigger"
                            icon="heroicon-o-squares-2x2"
                            class="arabic-text whitespace-nowrap font-medium"
                            x-bind:class="{ 'bg-muted/50': open }"
                        >
                            المنتجات
                        </x-strata::button>

                        <!-- Mega Menu with x-teleport -->
                        <template x-teleport="body">
                            <div
                                x-show="open"
                                x-anchor.bottom-start.offset.8="$refs.megaMenuTrigger"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-[-10px]"
                                class="w-screen max-w-4xl bg-card/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-border/50 overflow-hidden z-[9999]"
                                x-cloak
                            >
                                <div class="p-8">
                                    <div class="mb-8">
                                        <h3 class="text-xl font-bold arabic-heading text-foreground mb-2">منتجاتنا الطبيعية</h3>
                                        <p class="text-sm text-muted-foreground arabic-text">اكتشف مجموعة منتجاتنا الطبيعية المتميزة</p>
                                    </div>

                                    @if($featuredProduct || $regularProducts->count() > 0)
                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                                            <!-- Featured Product (if exists) -->
                                            @if($featuredProduct)
                                                <div class="lg:col-span-2">
                                                    <div class="bg-gradient-to-br from-primary/5 to-accent/5 rounded-xl p-1">
                                                        <a href="{{ route('product.show', $featuredProduct) ?? '#' }}"
                                                           class="group relative block bg-card rounded-lg p-4 hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">

                                                            <!-- Featured Badge -->
                                                            <div class="absolute top-3 right-3 bg-primary text-primary-foreground px-3 py-1 rounded-full text-xs font-medium arabic-text shadow-lg z-20">
                                                                مميز
                                                            </div>

                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                                <div class="aspect-square rounded-lg bg-muted overflow-hidden">
                                                                    @if($featuredProduct->image_path)
                                                                        <img src="{{ asset('storage/' . $featuredProduct->image_path) }}"
                                                                             alt="{{ $featuredProduct->name_ar }}"
                                                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                                                    @else
                                                                        <div class="w-full h-full flex items-center justify-center">
                                                                            <x-icon name="heroicon-o-photo" class="w-12 h-12 text-muted-foreground" />
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                <div class="flex flex-col justify-center space-y-2">
                                                                    <h4 class="font-bold arabic-text text-foreground group-hover:text-primary transition-colors text-base leading-tight">
                                                                        {{ $featuredProduct->name_ar }}
                                                                    </h4>
                                                                    @if($featuredProduct->description_ar)
                                                                        <p class="text-xs text-muted-foreground arabic-text line-clamp-2">
                                                                            {{ Str::limit($featuredProduct->description_ar, 80) }}
                                                                        </p>
                                                                    @endif
                                                                    <div class="space-y-1">
                                                                        @if($featuredProduct->price)
                                                                            <p class="text-sm font-bold text-primary">
                                                                                {{ number_format($featuredProduct->price, 0) }} د.ت
                                                                            </p>
                                                                        @endif
                                                                        @if($featuredProduct->size)
                                                                            <p class="text-xs text-muted-foreground">
                                                                                {{ $featuredProduct->size }}
                                                                            </p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Regular Products -->
                                            <div class="space-y-4">
                                                @foreach($regularProducts as $product)
                                                    <a href="{{ route('product.show', $product) ?? '#' }}"
                                                       class="group flex items-center gap-3 bg-card rounded-lg p-3 hover:shadow-md transition-all duration-300 hover:bg-muted/30">
                                                        <div class="w-16 h-16 rounded-md bg-muted overflow-hidden flex-shrink-0">
                                                            @if($product->image_path)
                                                                <img src="{{ asset('storage/' . $product->image_path) }}"
                                                                     alt="{{ $product->name_ar }}"
                                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                                            @else
                                                                <div class="w-full h-full flex items-center justify-center">
                                                                    <x-icon name="heroicon-o-photo" class="w-6 h-6 text-muted-foreground" />
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <h4 class="font-medium arabic-text text-foreground group-hover:text-primary transition-colors text-sm line-clamp-1">
                                                                {{ $product->name_ar }}
                                                            </h4>
                                                            @if($product->price)
                                                                <p class="text-xs font-medium text-primary">
                                                                    {{ number_format($product->price, 0) }} د.ت
                                                                </p>
                                                            @endif
                                                            @if($product->size)
                                                                <p class="text-xs text-muted-foreground truncate">
                                                                    {{ $product->size }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- View All Products Button -->
                                        <div class="mt-8 pt-6 border-t border-border">
                                            <x-strata::button
                                                href="{{ route('products.index') }}"
                                                variant="primary"
                                                size="lg"
                                                icon="heroicon-o-arrow-left"
                                                iconPosition="right"
                                                class="w-full"
                                            >
                                                عرض جميع المنتجات
                                            </x-strata::button>
                                        </div>
                                    @else
                                        <!-- Empty State -->
                                        <div class="text-center py-12">
                                            <x-icon name="heroicon-o-cube" class="w-16 h-16 text-muted-foreground mx-auto mb-4" />
                                            <p class="text-muted-foreground arabic-text">لا توجد منتجات متاحة حالياً</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Mobile Menu Button for mobile -->
                <div class="flex items-center md:hidden">
                    <x-strata::button
                        variant="ghost"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        x-ref="mobileMenuTrigger"
                        aria-label="Toggle mobile menu"
                    >
                        <x-icon name="heroicon-o-bars-3" class="w-6 h-6 text-foreground" x-show="!mobileMenuOpen" />
                        <x-icon name="heroicon-o-x-mark" class="w-6 h-6 text-foreground" x-show="mobileMenuOpen" />
                    </x-strata::button>
                </div>
            </div>

            <!-- Center Column: Logo (justify-center) -->
            <div class="flex items-center justify-center">
                <x-logo size="h-20" />
            </div>

            <!-- Right Column: Contact + Theme Toggle (justify-end) -->
            <div class="flex items-center justify-end gap-6 text-sm text-muted-foreground">
                <div class="hidden md:flex items-center gap-3">
                    <x-icon name="heroicon-o-phone" class="w-4 h-4 text-primary" />
                    <a href="tel:21526011" class="text-foreground hover:text-primary transition-colors duration-200 no-underline font-medium">
                        21.526.011
                    </a>
                    <span class="text-muted-foreground/60">/</span>
                    <a href="tel:29082808" class="text-foreground hover:text-primary transition-colors duration-200 no-underline font-medium">
                        29.082.808
                    </a>
                </div>
                
                <!-- Theme Toggle -->
                <div class="hidden md:flex items-center">
                    <div
                        x-data="{
                            isDark: false,
                            init() {
                                this.isDark = localStorage.getItem('theme') === 'dark' ||
                                    (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
                                this.applyTheme();
                            },
                            async toggle(event) {
                                const newTheme = !this.isDark;

                                // Check for View Transitions API support and user motion preferences
                                if (
                                    !document.startViewTransition ||
                                    window.matchMedia('(prefers-reduced-motion: reduce)').matches
                                ) {
                                    // Fallback to regular theme switch
                                    this.isDark = newTheme;
                                    localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                                    this.applyTheme();
                                    return;
                                }

                                // Get the toggle switch position for the expanding circle animation
                                const toggleElement = event.target.closest('label') || event.target;
                                const rect = toggleElement.getBoundingClientRect();
                                const x = rect.left + rect.width / 2;
                                const y = rect.top + rect.height / 2;

                                // Calculate maximum radius to cover the entire screen
                                const endRadius = Math.hypot(
                                    Math.max(x, window.innerWidth - x),
                                    Math.max(y, window.innerHeight - y)
                                );

                                // Start the view transition
                                const transition = document.startViewTransition(async () => {
                                    this.isDark = newTheme;
                                    localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                                    this.applyTheme();
                                });

                                // Wait for the transition to be ready, then animate
                                try {
                                    await transition.ready;

                                    // Animate the expanding circle
                                    document.documentElement.animate(
                                        {
                                            clipPath: [
                                                `circle(0px at ${x}px ${y}px)`,
                                                `circle(${endRadius}px at ${x}px ${y}px)`
                                            ]
                                        },
                                        {
                                            duration: 500,
                                            easing: 'ease-in-out',
                                            pseudoElement: '::view-transition-new(root)'
                                        }
                                    );
                                } catch (e) {
                                    // If animation fails, fallback to regular theme switch
                                    console.warn('View transition animation failed:', e);
                                }
                            },
                            applyTheme() {
                                document.documentElement.classList.toggle('dark', this.isDark);
                                document.documentElement.classList.toggle('light', !this.isDark);

                                // Dispatch custom event for logo component
                                document.dispatchEvent(new CustomEvent('theme-changed', {
                                    detail: { isDark: this.isDark }
                                }));
                            }
                        }"
                        x-init="init()"
                        class="inline-flex items-center"
                    >
                        <label
                            class="relative inline-flex items-center cursor-pointer"
                            aria-label="Toggle dark mode"
                        >
                            <input
                                type="checkbox"
                                class="sr-only peer"
                                :checked="isDark"
                                @change="toggle($event)"
                            >
                            <div
                                class="
                                    w-14 h-8 bg-input rounded-full peer border border-border
                                    peer-focus:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-focus-visible:ring-ring
                                    peer-checked:bg-primary transition-all duration-300
                                "
                            ></div>
                            <div
                                class="
                                    absolute top-1 left-1 bg-background rounded-full h-6 w-6 border border-border
                                    transition-transform duration-300 transform shadow-sm
                                    peer-checked:translate-x-6
                                    flex items-center justify-center
                                "
                            >
                                <x-icon
                                    name="heroicon-o-sun"
                                    class="w-4 h-4 text-yellow-500"
                                    x-show="!isDark"
                                    x-cloak
                                    x-transition:enter="transition ease-out duration-200 delay-100"
                                    x-transition:enter-start="opacity-0 scale-75"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-75"
                                />
                                <x-icon
                                    name="heroicon-o-moon"
                                    class="w-4 h-4 text-indigo-500"
                                    x-show="isDark"
                                    x-cloak
                                    x-transition:enter="transition ease-out duration-200 delay-100"
                                    x-transition:enter-start="opacity-0 scale-75"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-75"
                                />
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu with teleport and global state -->
        <template x-teleport="body">
            <div x-data="{ get mobileMenuOpen() { return $store.mobileMenu.open }, set mobileMenuOpen(value) { $store.mobileMenu.open = value } }">
                <!-- Backdrop -->
                <div
                    x-show="mobileMenuOpen"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click="mobileMenuOpen = false"
                    class="fixed top-20 left-0 right-0 bottom-0 bg-black/60 backdrop-blur-md z-[9998] md:hidden"
                ></div>

                <!-- Mobile Menu -->
                <div
                    x-show="mobileMenuOpen"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-[-10px]"
                    class="fixed top-20 left-0 right-0 w-full bg-card/95 backdrop-blur-xl rounded-b-2xl shadow-2xl border-b border-l border-r border-border/50 overflow-hidden z-[9999] md:hidden"
                    @click.away="mobileMenuOpen = false"
                >
            <div class="p-6 space-y-6">
                <!-- Theme Toggle (Mobile) -->
                <div class="pb-4 border-b border-border/30">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-foreground arabic-text">المظهر</span>
                        <div
                            x-data="{
                                isDark: false,
                                init() {
                                    this.isDark = localStorage.getItem('theme') === 'dark' ||
                                        (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
                                    this.applyTheme();
                                },
                                async toggle(event) {
                                    const newTheme = !this.isDark;
                                    this.isDark = newTheme;
                                    localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                                    this.applyTheme();
                                },
                                applyTheme() {
                                    document.documentElement.classList.toggle('dark', this.isDark);
                                    document.documentElement.classList.toggle('light', !this.isDark);
                                    document.dispatchEvent(new CustomEvent('theme-changed', {
                                        detail: { isDark: this.isDark }
                                    }));
                                }
                            }"
                            x-init="init()"
                            class="inline-flex items-center"
                        >
                            <label class="relative inline-flex items-center cursor-pointer" aria-label="Toggle dark mode">
                                <input type="checkbox" class="sr-only peer" :checked="isDark" @change="toggle($event)">
                                <div class="w-12 h-6 bg-input rounded-full peer border border-border peer-focus:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-focus-visible:ring-ring peer-checked:bg-primary transition-all duration-300"></div>
                                <div class="absolute top-0.5 left-0.5 bg-background rounded-full h-5 w-5 border border-border transition-transform duration-300 transform shadow-sm peer-checked:translate-x-6 flex items-center justify-center">
                                    <x-icon name="heroicon-o-sun" class="w-3 h-3 text-yellow-500" x-show="!isDark" x-cloak />
                                    <x-icon name="heroicon-o-moon" class="w-3 h-3 text-indigo-500" x-show="isDark" x-cloak />
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Mobile Navigation Links -->
                <div class="space-y-3">
                    <h4 class="text-sm font-medium text-foreground arabic-text">التنقل</h4>
                    <div class="space-y-2">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 text-muted-foreground hover:text-primary transition-colors p-2 rounded-lg hover:bg-muted/50">
                            <x-icon name="heroicon-o-home" class="w-5 h-5" />
                            <span class="text-sm arabic-text">الرئيسية</span>
                        </a>
                        <a href="{{ route('products.index') }}" class="flex items-center gap-3 text-muted-foreground hover:text-primary transition-colors p-2 rounded-lg hover:bg-muted/50">
                            <x-icon name="heroicon-o-squares-2x2" class="w-5 h-5" />
                            <span class="text-sm arabic-text">المنتجات</span>
                        </a>
                    </div>
                </div>

                <!-- Mobile Contact Info -->
                <div class="space-y-3">
                    <h4 class="text-sm font-medium text-foreground arabic-text">تواصل معنا</h4>
                    <div class="space-y-2">
                        <a href="tel:21526011" class="flex items-center gap-3 text-muted-foreground hover:text-primary transition-colors p-2 rounded-lg hover:bg-muted/50">
                            <x-icon name="heroicon-o-phone" class="w-4 h-4 text-primary" />
                            <span class="text-sm">21.526.011</span>
                        </a>
                        <a href="tel:29082808" class="flex items-center gap-3 text-muted-foreground hover:text-primary transition-colors p-2 rounded-lg hover:bg-muted/50">
                            <x-icon name="heroicon-o-phone" class="w-4 h-4 text-primary" />
                            <span class="text-sm">29.082.808</span>
                        </a>
                    </div>
                </div>

                <!-- Mobile Social Links -->
                <div class="space-y-3">
                    <h4 class="text-sm font-medium text-foreground arabic-text">تابعنا</h4>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/profile.php?id=61566967662907" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-primary/10 hover:bg-primary hover:text-background text-primary rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-105" aria-label="Follow us on Facebook">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/nahlabio_labo/" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-primary/10 hover:bg-primary hover:text-background text-primary rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-105" aria-label="Follow us on Instagram">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </template>
    </div>
</header>
