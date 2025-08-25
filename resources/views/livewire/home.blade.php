{{-- Hero Section --}}
<div class="relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            {{-- Left Column - Text Content --}}
            <div class="space-y-8 lg:pr-8">
                {{-- Main Heading --}}
                <div class="space-y-6">
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
                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="bg-primary hover:bg-primary/90 text-primary-foreground px-8 py-4 rounded-xl font-semibold arabic-text transition-all duration-300 transform hover:scale-105 shadow-lg">
                        اكتشف منتجاتنا
                    </button>
                    <button class="border border-border hover:bg-muted text-foreground px-8 py-4 rounded-xl font-medium arabic-text transition-all duration-300">
                        تعرف علينا أكثر
                    </button>
                </div>

                {{-- Social Proof --}}
                <div class="space-y-6 pt-8">
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-2">
                            <div class="w-10 h-10 bg-primary/20 rounded-full border-2 border-background flex items-center justify-center">
                                <span class="text-xs font-bold text-primary">س</span>
                            </div>
                            <div class="w-10 h-10 bg-accent/20 rounded-full border-2 border-background flex items-center justify-center">
                                <span class="text-xs font-bold text-accent">ف</span>
                            </div>
                            <div class="w-10 h-10 bg-primary/30 rounded-full border-2 border-background flex items-center justify-center">
                                <span class="text-xs font-bold text-primary">ن</span>
                            </div>
                            <div class="w-10 h-10 bg-muted rounded-full border-2 border-background flex items-center justify-center text-muted-foreground">
                                <span class="text-xs">+</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium arabic-text">أكثر من 500+ عميل راضي</p>
                            <p class="text-xs text-muted-foreground arabic-text">يثقون في منتجاتنا الطبيعية</p>
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-6 pt-4 border-t border-border">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-primary">100%</p>
                            <p class="text-xs text-muted-foreground arabic-text">طبيعي</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-primary">0%</p>
                            <p class="text-xs text-muted-foreground arabic-text">مواد كيماوية</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-primary">24/7</p>
                            <p class="text-xs text-muted-foreground arabic-text">دعم العملاء</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column - Product Showcase --}}
            <div class="relative">
                {{-- Decorative Background --}}
                <div class="absolute inset-0 flex items-center justify-center opacity-10">
                    <img 
                        src="{{ asset('vintage-flower-illustration.png') }}" 
                        alt="Decorative flower illustration" 
                        class="w-full h-full object-contain max-w-lg"
                    >
                </div>

                {{-- Products and Reviews Grid --}}
                <div class="relative z-10 grid grid-cols-2 gap-6">
                    {{-- Featured Products --}}
                    @foreach($featuredProducts as $index => $product)
                        <div class="group {{ $index === 1 ? 'mt-8' : '' }}">
                            <div class="bg-card border border-border rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                                {{-- Product Image --}}
                                <div class="aspect-square bg-muted rounded-xl overflow-hidden mb-4">
                                    @if($product->image_path)
                                        <img 
                                            src="{{ asset('storage/' . $product->image_path) }}" 
                                            alt="{{ $product->name_ar }}" 
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <x-icon name="heroicon-o-photo" class="w-16 h-16 text-muted-foreground" />
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- Product Info --}}
                                <div class="space-y-2">
                                    <h3 class="font-semibold arabic-text text-sm leading-tight">{{ $product->name_ar }}</h3>
                                    @if($product->price)
                                        <p class="text-primary font-bold">{{ number_format($product->price, 2) }} د.ت</p>
                                    @endif
                                </div>
                                
                                {{-- Expanding CTA Button --}}
                                <div class="max-h-0 group-hover:max-h-20 overflow-hidden transition-all duration-300 ease-in-out">
                                    <div class="pt-4">
                                        <button class="w-full bg-primary hover:bg-primary/90 text-primary-foreground py-2 px-4 rounded-lg text-sm font-medium arabic-text transition-colors transform translate-y-2 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300 delay-100">
                                            عرض التفاصيل
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Rotating Testimonial --}}
                    <div class="col-span-2 mt-6">
                        <div class="bg-card border border-border rounded-xl p-4 shadow-md relative overflow-hidden">
                            <div id="testimonial-container" class="transition-all duration-500 ease-in-out">
                                <!-- Testimonials will be inserted here by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Floating Elements --}}
    <div class="absolute top-20 right-10 w-16 h-16 bg-primary/10 rounded-full blur-xl"></div>
    <div class="absolute bottom-32 left-16 w-24 h-24 bg-accent/10 rounded-full blur-xl"></div>
    <div class="absolute top-1/2 left-1/4 w-8 h-8 bg-primary/20 rounded-full blur-lg"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const testimonials = [
        {
            name: 'سارة أحمد',
            initial: 'س',
            color: 'primary',
            text: 'منتجات رائعة وطبيعية 100%. بشرتي أصبحت أكثر نعومة ونضارة.'
        },
        {
            name: 'فاطمة محمد',
            initial: 'ف',
            color: 'accent',
            text: 'أعجبني كثيراً كريم الترطيب. يدوم طويلاً ولا يترك ملمس دهني.'
        },
        {
            name: 'نور الهدى',
            initial: 'ن',
            color: 'primary',
            text: 'خدمة ممتازة ومنتجات عالية الجودة. أنصح الجميع بتجربتها.'
        },
        {
            name: 'أميرة سالم',
            initial: 'أ',
            color: 'accent',
            text: 'السبراي الطبيعي ساعدني كثيراً في حل مشاكل البشرة. شكراً نهلة.'
        },
        {
            name: 'ليلى حسن',
            initial: 'ل',
            color: 'primary',
            text: 'منتجات آمنة ومفيدة جداً. أستخدمها منذ شهور والنتيجة مذهلة.'
        }
    ];

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
            'bg-purple-100 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400' : 
            'bg-pink-100 text-pink-600 dark:bg-pink-900/20 dark:text-pink-400';

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
        // Add fade out effect
        container.style.opacity = '0';
        container.style.transform = 'translateY(10px)';
        
        setTimeout(() => {
            // Get random testimonial
            let randomIndex;
            do {
                randomIndex = Math.floor(Math.random() * testimonials.length);
            } while (randomIndex === currentIndex && testimonials.length > 1);
            
            currentIndex = randomIndex;
            container.innerHTML = renderTestimonial(testimonials[currentIndex]);
            
            // Add fade in effect
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, 250);
    }

    // Initialize with first testimonial
    if (container) {
        container.innerHTML = renderTestimonial(testimonials[0]);
        
        // Start rotation
        setInterval(showNextTestimonial, 4000);
    }
});
</script>