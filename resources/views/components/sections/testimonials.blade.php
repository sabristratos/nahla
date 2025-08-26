@props([
    'title' => 'آراء عملائنا',
    'subtitle' => 'اكتشف تجارب عملائنا مع منتجاتنا الطبيعية عالية الجودة',
])

<div class="py-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-16" x-reveal="{ direction: 'up', duration: 0.8 }">
            <h2 class="text-4xl lg:text-5xl font-bold arabic-heading text-foreground mb-6">
                {{ $title }}
            </h2>
            <p class="text-lg !text-center text-muted-foreground arabic-text max-w-3xl mx-auto leading-relaxed">
                {{ $subtitle }}
            </p>

            {{-- Decorative line --}}
            <div class="flex items-center justify-center mt-8">
                <div class="h-px bg-gradient-to-r from-transparent via-primary to-transparent w-32"></div>
                <div class="mx-4 w-2 h-2 bg-primary rounded-full"></div>
                <div class="h-px bg-gradient-to-r from-primary via-accent to-transparent w-32"></div>
            </div>
        </div>

        {{-- Testimonials Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-reveal="{ direction: 'up', delay: 0.2, stagger: 0.1 }">

            {{-- Testimonial 1 --}}
            <div class="bg-card/60 backdrop-blur-xl border border-border/30 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="relative">
                    {{-- Quote Icon --}}
                    <div class="absolute -top-2 -right-2 text-4xl text-primary dark:text-primary font-serif opacity-60">"</div>

                    <div class="flex items-start gap-3 mt-4">
                        <div class="w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold">أ</span>
                        </div>
                        <div class="flex-1">
                            {{-- Stars --}}
                            <div class="flex items-center gap-1 mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endfor
                            </div>

                            <p class="text-sm text-muted-foreground arabic-text mb-3 leading-relaxed">
                                "منتجات رائعة وطبيعية 100%. زيت الخروع ساعدني كثيراً في تقوية شعري وإعطائه لمعان طبيعي. أنصح الجميع بتجربة منتجات نهلابيو."
                            </p>

                            <p class="text-sm font-semibold text-foreground arabic-text">أحمد محمد</p>
                            <p class="text-xs text-muted-foreground arabic-text">تونس العاصمة</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 2 --}}
            <div class="bg-card/60 backdrop-blur-xl border border-border/30 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="relative">
                    {{-- Quote Icon --}}
                    <div class="absolute -top-2 -right-2 text-4xl text-accent dark:text-accent font-serif opacity-60">"</div>

                    <div class="flex items-start gap-3 mt-4">
                        <div class="w-10 h-10 bg-accent/10 text-accent rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold">ف</span>
                        </div>
                        <div class="flex-1">
                            {{-- Stars --}}
                            <div class="flex items-center gap-1 mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endfor
                            </div>

                            <p class="text-sm text-muted-foreground arabic-text mb-3 leading-relaxed">
                                "كريم مرطب ممتاز! بشرتي أصبحت أكثر نعومة ونضارة. أحب أن جميع المنتجات طبيعية وآمنة. خدمة عملاء ممتازة أيضاً."
                            </p>

                            <p class="text-sm font-semibold text-foreground arabic-text">فاطمة الزهراء</p>
                            <p class="text-xs text-muted-foreground arabic-text">صفاقس</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 3 --}}
            <div class="bg-card/60 backdrop-blur-xl border border-border/30 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="relative">
                    {{-- Quote Icon --}}
                    <div class="absolute -top-2 -right-2 text-4xl text-primary dark:text-primary font-serif opacity-60">"</div>

                    <div class="flex items-start gap-3 mt-4">
                        <div class="w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold">م</span>
                        </div>
                        <div class="flex-1">
                            {{-- Stars --}}
                            <div class="flex items-center gap-1 mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endfor
                            </div>

                            <p class="text-sm text-muted-foreground arabic-text mb-3 leading-relaxed">
                                "زبدة الشيا من نهلابيو لها تأثير سحري على البشرة الجافة. أستخدمها يومياً وأرى الفرق واضحاً. منتج طبيعي وعالي الجودة."
                            </p>

                            <p class="text-sm font-semibold text-foreground arabic-text">محمد الهادي</p>
                            <p class="text-xs text-muted-foreground arabic-text">سوسة</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 4 --}}
            <div class="bg-card/60 backdrop-blur-xl border border-border/30 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="relative">
                    {{-- Quote Icon --}}
                    <div class="absolute -top-2 -right-2 text-4xl text-accent dark:text-accent font-serif opacity-60">"</div>

                    <div class="flex items-start gap-3 mt-4">
                        <div class="w-10 h-10 bg-accent/10 text-accent rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold">ل</span>
                        </div>
                        <div class="flex-1">
                            {{-- Stars --}}
                            <div class="flex items-center gap-1 mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endfor
                            </div>

                            <p class="text-sm text-muted-foreground arabic-text mb-3 leading-relaxed">
                                "الجل المضاد للآلام فعال جداً للآلام العضلية. أستخدمه بعد التمرين وأشعر بالراحة فوراً. شكراً نهلابيو على هذه المنتجات الرائعة."
                            </p>

                            <p class="text-sm font-semibold text-foreground arabic-text">ليلى بن علي</p>
                            <p class="text-xs text-muted-foreground arabic-text">المنستير</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 5 --}}
            <div class="bg-card/60 backdrop-blur-xl border border-border/30 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="relative">
                    {{-- Quote Icon --}}
                    <div class="absolute -top-2 -right-2 text-4xl text-primary dark:text-primary font-serif opacity-60">"</div>

                    <div class="flex items-start gap-3 mt-4">
                        <div class="w-10 h-10 bg-primary/10 text-primary rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold">ع</span>
                        </div>
                        <div class="flex-1">
                            {{-- Stars --}}
                            <div class="flex items-center gap-1 mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endfor
                            </div>

                            <p class="text-sm text-muted-foreground arabic-text mb-3 leading-relaxed">
                                "خل التفاح من أجود الأنواع التي جربتها. طعمه طبيعي ومفيد جداً للهضم والصحة العامة. أنصح الجميع بالتجربة."
                            </p>

                            <p class="text-sm font-semibold text-foreground arabic-text">عمر الكريم</p>
                            <p class="text-xs text-muted-foreground arabic-text">قابس</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 6 --}}
            <div class="bg-card/60 backdrop-blur-xl border border-border/30 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="relative">
                    {{-- Quote Icon --}}
                    <div class="absolute -top-2 -right-2 text-4xl text-accent dark:text-accent font-serif opacity-60">"</div>

                    <div class="flex items-start gap-3 mt-4">
                        <div class="w-10 h-10 bg-accent/10 text-accent rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold">س</span>
                        </div>
                        <div class="flex-1">
                            {{-- Stars --}}
                            <div class="flex items-center gap-1 mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endfor
                            </div>

                            <p class="text-sm text-muted-foreground arabic-text mb-3 leading-relaxed">
                                "الكريم المزيل للعرق الطبيعي مدهش! لا يحتوي على مواد كيميائية ضارة ويحمي طوال اليوم. أفضل من المنتجات التجارية بكثير."
                            </p>

                            <p class="text-sm font-semibold text-foreground arabic-text">سارة الماجري</p>
                            <p class="text-xs text-muted-foreground arabic-text">بنزرت</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Call to Action --}}
        <div class="text-center mt-16" x-reveal="{ direction: 'up', delay: 0.4 }">
            <div class="bg-gradient-to-r from-primary/10 via-accent/5 to-primary/10 rounded-3xl p-8 max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold text-foreground arabic-heading mb-4">
                    شارك تجربتك معنا
                </h3>
                <p class="text-muted-foreground arabic-text mb-6">
                    نحن نقدر آراء عملائنا ونسعد بسماع تجربتك مع منتجاتنا الطبيعية
                </p>
                <x-strata::button 
                    variant="primary" 
                    size="lg" 
                    class="px-8"
                    @click="$dispatch('open-contact-modal')"
                >
                    تواصل معنا
                </x-strata::button>
            </div>
        </div>
    </div>

    {{-- Background Decorative Elements --}}
    <div class="absolute top-1/4 left-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-1/4 right-10 w-40 h-40 bg-accent/5 rounded-full blur-3xl -z-10"></div>
    <div class="absolute top-3/4 left-1/4 w-24 h-24 bg-primary/3 rounded-full blur-2xl -z-10"></div>
</div>
