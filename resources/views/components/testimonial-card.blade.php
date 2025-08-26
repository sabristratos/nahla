@props([
    'floating' => false,
    'position' => 'bottom-[40%] right-[5%]',
    'width' => 'w-[320px]',
    'delayed' => false,
    'testimonials' => collect([]),
])

<div class="{{ $floating ? 'absolute z-30 transform hover:scale-105 transition-all duration-500 ' . $position . ' ' . $width : 'relative' }}"
     @if($delayed)
     x-data="{ show: false }" 
     x-init="setTimeout(() => show = true, 1200)"
     x-show="show"
     x-transition:enter="transition ease-out duration-800 transform-gpu"
     x-transition:enter-start="opacity-0 scale-75"
     x-transition:enter-end="opacity-100 scale-100"
     @endif>
    <div class="{{ $floating ? 'bg-background/80 dark:bg-background/90 backdrop-blur-xl border border-border/30' : 'bg-card border border-border' }} rounded-2xl p-6 shadow-2xl">
        {{-- Glass morphism effect background for floating variant --}}
        @if($floating)
            <div class="absolute inset-0 bg-gradient-to-br from-background/50 to-card/30 rounded-2xl"></div>
        @endif

        <div class="relative">
            {{-- Quote Icon --}}
            <div class="absolute -top-2 -left-2 text-4xl text-primary dark:text-primary font-serif opacity-60">"</div>

            <div id="testimonial-container" class="transition-all duration-500 ease-in-out">
                <!-- Testimonials will be inserted here by JavaScript -->
            </div>
        </div>
    </div>
</div>

@if($testimonials->count() > 0)
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const testimonials = @js($testimonials->map(function($testimonial, $index) {
        return [
            'name' => $testimonial->customer_name,
            'initial' => mb_substr($testimonial->customer_name, 0, 1),
            'color' => $index % 2 === 0 ? 'primary' : 'accent',
            'text' => $testimonial->review_text_ar
        ];
    })->values());

    let currentIndex = 0;
    const container = document.getElementById('testimonial-container');

    function createStars() {
        let starsHtml = '';
        for (let i = 0; i < 5; i++) {
            starsHtml += `<svg class="w-3 h-3 text-yellow-500 fill-current" viewBox="0 0 20 20">
                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
            </svg>`;
        }
        return starsHtml;
    }

    function renderTestimonial(testimonial) {
        const colorClass = testimonial.color === 'primary' ?
            'bg-primary/10 text-primary' :
            'bg-accent/10 text-accent';

        return `
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 ${colorClass} rounded-full flex items-center justify-center">
                    <span class="text-xs font-bold">${testimonial.initial}</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-1 mb-1">
                        ${createStars()}
                    </div>
                    <p class="text-xs text-muted-foreground arabic-text">"${testimonial.text}"</p>
                    <p class="text-xs font-medium text-foreground mt-1 arabic-text">${testimonial.name}</p>
                </div>
            </div>
        `;
    }

    function showNextTestimonial() {
        // Import GSAP animation function if available
        if (typeof window.animateTestimonialTransition === 'function') {
            // Get random testimonial
            let randomIndex;
            do {
                randomIndex = Math.floor(Math.random() * testimonials.length);
            } while (randomIndex === currentIndex && testimonials.length > 1);
            
            currentIndex = randomIndex;
            const newContent = renderTestimonial(testimonials[currentIndex]);
            
            // Use GSAP animation
            window.animateTestimonialTransition(container, newContent);
        } else {
            // Fallback to CSS animations - zoom from center
            container.style.opacity = '0';
            container.style.transform = 'scale(0.95)';
            container.style.transformOrigin = 'center center';
            container.style.transition = 'all 0.3s ease-in-out';

            setTimeout(() => {
                // Get random testimonial
                let randomIndex;
                do {
                    randomIndex = Math.floor(Math.random() * testimonials.length);
                } while (randomIndex === currentIndex && testimonials.length > 1);

                currentIndex = randomIndex;
                container.innerHTML = renderTestimonial(testimonials[currentIndex]);

                // Enhanced zoom in effect from center
                container.style.opacity = '1';
                container.style.transform = 'scale(1)';
                container.style.transformOrigin = 'center center';
            }, 300);
        }
    }

    // Initialize with first testimonial
    if (container && testimonials.length > 0) {
        container.innerHTML = renderTestimonial(testimonials[0]);

        // Start rotation if we have more than one testimonial
        if (testimonials.length > 1) {
            setInterval(showNextTestimonial, 4000);
        }
    }
});
</script>
@endpush
@else
{{-- Fallback content when no testimonials --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('testimonial-container');
    if (container) {
        container.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-primary/10 text-primary rounded-full flex items-center justify-center">
                    <span class="text-xs font-bold">ع</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-1 mb-1">
                        ${Array(5).fill().map(() => '<svg class="w-3 h-3 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>').join('')}
                    </div>
                    <p class="text-xs text-muted-foreground arabic-text">"منتجات رائعة وطبيعية عالية الجودة"</p>
                    <p class="text-xs font-medium text-foreground mt-1 arabic-text">العميل المميز</p>
                </div>
            </div>
        `;
    }
});
</script>
@endpush
@endif
