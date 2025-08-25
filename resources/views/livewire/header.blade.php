<header class="backdrop-blur-sm sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl py-6 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between  min-h-16">
            <!-- Left: Contact Information -->
            <div class="flex items-center space-x-6 text-sm text-muted-foreground">
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
            </div>

            <!-- Center: Logo -->
            <div class="absolute left-1/2 transform -translate-x-1/2">
                <x-logo size="h-20" />
            </div>

            <!-- Right: Products Mega Menu & Theme Switcher -->
            <div class="flex items-center space-x-4">
                <!-- Products Mega Menu -->
                <div
                    x-data="{ open: false }"
                    class="relative"
                    @click.away="open = false"
                >
                    <button
                        @click="open = !open"
                        class="flex items-center space-x-2 text-foreground hover:text-primary transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-muted/50"
                        :class="{ 'bg-muted/50': open }"
                    >
                        <x-icon name="heroicon-o-squares-2x2" class="w-5 h-5" />
                        <span class="arabic-text font-medium">المنتجات</span>
                        <x-icon name="heroicon-o-chevron-down" class="w-4 h-4 transition-transform duration-200" x-bind:class="{ 'rotate-180': open }" />
                    </button>

                    <!-- Mega Menu -->
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute right-0 mt-3 w-screen max-w-6xl bg-popover/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-border/50 overflow-hidden z-50"
                        style="transform: translateX(calc(100% - 200px));"
                        x-cloak
                    >
                        <div class="p-8">
                            <div class="mb-6">
                                <h3 class="text-xl font-bold arabic-heading text-foreground mb-2">منتجاتنا الطبيعية</h3>
                                <p class="text-sm text-muted-foreground arabic-text">اكتشف مجموعة منتجاتنا الطبيعية المتميزة</p>
                            </div>

                            <!-- Products Grid -->
                            <div class="grid grid-cols-4 gap-4">
                                @forelse($products as $product)
                                    <a href="{{ route('product.show', $product) ?? '#' }}"
                                       class="group block bg-card rounded-lg p-3 hover:shadow-md transition-all duration-300 hover:bg-muted/30">
                                        <div class="aspect-square rounded-md bg-muted mb-2 overflow-hidden">
                                            @if($product->image_path)
                                                <img src="{{ asset('storage/' . $product->image_path) }}"
                                                     alt="{{ $product->name_ar }}"
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <x-icon name="heroicon-o-photo" class="w-10 h-10 text-muted-foreground" />
                                                </div>
                                            @endif
                                        </div>
                                        <h4 class="font-medium arabic-text text-foreground mb-1 group-hover:text-primary transition-colors line-clamp-2 text-sm">
                                            {{ $product->name_ar }}
                                        </h4>
                                        @if($product->price)
                                            <p class="text-xs font-medium text-primary">
                                                {{ number_format($product->price, 2) }} د.ت
                                            </p>
                                        @endif
                                        @if($product->size)
                                            <p class="text-xs text-muted-foreground">
                                                {{ $product->size }}
                                            </p>
                                        @endif
                                    </a>
                                @empty
                                    <div class="col-span-full text-center py-12">
                                        <x-icon name="heroicon-o-cube" class="w-16 h-16 text-muted-foreground mx-auto mb-4" />
                                        <p class="text-muted-foreground arabic-text">لا توجد منتجات متاحة حالياً</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- View All Products Link -->
                            @if($products->count() > 0)
                                <div class="mt-8 pt-6 border-t border-border">
                                    <button
                                        onclick="document.getElementById('products-section')?.scrollIntoView({behavior: 'smooth'})"
                                        class="inline-flex items-center justify-center w-full px-6 py-3 bg-primary hover:bg-primary/90 text-primary-foreground font-medium rounded-lg transition-colors duration-200 arabic-text">
                                        <span>عرض جميع المنتجات</span>
                                        <x-icon name="heroicon-o-arrow-left" class="w-4 h-4 mr-2" />
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Theme Switcher -->
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

                <!-- Mobile Menu Button (for future mobile navigation) -->
                <button class="md:hidden p-2 rounded-lg hover:bg-muted transition-colors duration-200">
                    <x-icon name="heroicon-o-bars-3" class="w-6 h-6 text-foreground" />
                </button>
            </div>
        </div>
    </div>
</header>
