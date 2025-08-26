{{-- Product Images Grid --}}
<div class="relative h-full" x-data="{ imagesLoaded: false }" x-init="setTimeout(() => imagesLoaded = true, 100)">
    {{-- First Product Shot - Top Left --}}
    <div class="product-image absolute top-0 left-0 w-[45%] h-[45%] group" 
         x-show="imagesLoaded" 
         x-transition:enter="transition ease-out duration-1000 delay-[200ms]"
         x-transition:enter-start="opacity-0 scale-75 rotate-12"
         x-transition:enter-end="opacity-100 scale-100 rotate-0"
         x-hover-lift="{ scale: 1.08, y: -12 }">
        <div class="relative h-full rounded-2xl overflow-hidden shadow-2xl">
            <img 
                src="{{ asset('products/shot-1.jpg') }}" 
                alt="Product Shot 1" 
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>
    </div>

    {{-- Second Product Shot - Top Right, slightly lower --}}
    <div class="product-image absolute top-[8%] right-0 w-[50%] h-[50%] group" 
         x-show="imagesLoaded" 
         x-transition:enter="transition ease-out duration-1000 delay-[400ms]"
         x-transition:enter-start="opacity-0 scale-75 -rotate-12"
         x-transition:enter-end="opacity-100 scale-100 rotate-0"
         x-hover-lift="{ scale: 1.08, y: -12 }">
        <div class="relative h-full rounded-2xl overflow-hidden shadow-2xl">
            <img 
                src="{{ asset('products/shot-3.jpg') }}" 
                alt="Product Shot 2" 
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>
    </div>

    {{-- Third Product Shot - Bottom Center --}}
    <div class="product-image absolute bottom-[5%] left-1/2 transform -translate-x-1/2 w-[55%] h-[48%] group" 
         x-show="imagesLoaded" 
         x-transition:enter="transition ease-out duration-1000 delay-[600ms]"
         x-transition:enter-start="opacity-0 scale-75 rotate-6"
         x-transition:enter-end="opacity-100 scale-100 rotate-0"
         x-hover-lift="{ scale: 1.08, y: -12 }">
        <div class="relative h-full rounded-2xl overflow-hidden shadow-2xl">
            <img 
                src="{{ asset('products/shot-2.jpg') }}" 
                alt="Product Shot 3" 
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>
    </div>

    {{-- Floating Testimonial Card --}}
    <x-testimonial-card floating="true" :delayed="true" :testimonials="$featuredTestimonials" />

    {{-- Decorative Elements --}}
    <div class="absolute top-[25%] left-[20%] w-20 h-20 bg-primary/10 rounded-full blur-2xl" 
         x-float="{ amplitude: 15, duration: 4 }"></div>
    <div class="absolute bottom-[35%] right-[15%] w-16 h-16 bg-accent/10 rounded-full blur-2xl" 
         x-float="{ amplitude: 12, duration: 3.5 }"></div>
</div>