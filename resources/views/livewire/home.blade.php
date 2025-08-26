<div>
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                {{-- Left Column - Text Content --}}
                <div class="space-y-8 lg:pr-8">
                    @include('components.partials.hero-content')
                </div>

                {{-- Right Column - Product Showcase --}}
                <div class="relative h-[600px] lg:h-[700px]">
                    @include('components.partials.hero-product-showcase', ['featuredTestimonials' => $featuredTestimonials])
                </div>
            </div>
        </div>

        {{-- Floating Elements --}}
        <div class="absolute top-20 right-10 w-16 h-16 bg-primary/10 rounded-full blur-xl"></div>
        <div class="absolute bottom-32 left-16 w-24 h-24 bg-accent/10 rounded-full blur-xl"></div>
        <div class="absolute top-1/2 left-1/4 w-8 h-8 bg-primary/20 rounded-full blur-lg"></div>
    </div>

    {{-- Castor Oil Spotlight Section --}}
    <x-sections.castor-oil-spotlight
        videoPath="reel.mp4"
        imagePath="products/castor-oil-2.png"
        :product="$castorOilProduct"
    />

    {{-- Products Section --}}
    <x-sections.products :products="$products" />

    {{-- Testimonials Section --}}
    <x-sections.testimonials />
</div>
