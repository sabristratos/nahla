@props(['size' => 'h-20'])

<div
    x-data="{
        isDark: false,
        init() {
            this.isDark = localStorage.getItem('theme') === 'dark' ||
                (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

            // Watch for theme changes
            this.$watch('isDark', () => {
                this.updateLogo();
            });

            // Listen for storage changes (when theme is changed in another tab/component)
            window.addEventListener('storage', (e) => {
                if (e.key === 'theme') {
                    this.isDark = e.newValue === 'dark';
                }
            });

            // Listen for theme changes from the theme toggle
            document.addEventListener('theme-changed', (e) => {
                this.isDark = e.detail.isDark;
            });

            this.updateLogo();
        },
        updateLogo() {
            // Force reactivity
            this.$nextTick(() => {
                this.isDark = document.documentElement.classList.contains('dark');
            });
        }
    }"
    x-init="init()"
    class="flex items-center"
>
    <a href="{{ route('home') ?? '/' }}" class="flex items-center no-underline">
        <!-- Light mode logo (dark text) -->
        <img
            x-show="!isDark"
            src="{{ asset('logo-dark.png') }}"
            alt="Nahla Logo"
            class="{{ $size }} w-auto transition-opacity duration-300"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >

        <!-- Dark mode logo (light text) -->
        <img
            x-show="isDark"
            src="{{ asset('logo-light.png') }}"
            alt="Nahla Logo"
            class="{{ $size }} w-auto transition-opacity duration-300"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
    </a>
</div>
