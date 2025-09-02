<footer class="relative mt-24 bg-gradient-to-br from-card/80 to-background border-t border-border/30">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-10 left-10 w-32 h-32 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-primary/5 rounded-full blur-2xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- Company Info --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Logo --}}
                <div class="mb-6">
                    <x-logo size="h-16" />
                </div>

                {{-- Description --}}
                <p class="text-muted-foreground arabic-text leading-relaxed max-w-md">
                    نحن ملتزمون بتقديم أفضل المنتجات الطبيعية عالية الجودة للعناية بصحتك وجمالك. جميع منتجاتنا طبيعية 100% ومصنوعة بعناية فائقة.
                </p>

                {{-- Contact Info --}}
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-foreground arabic-heading">تواصل معنا</h4>
                    <div class="space-y-3">
                        <a href="tel:+21620987654" class="flex items-center gap-3 text-muted-foreground hover:text-primary transition-colors">
                            <div class="w-5 h-5 text-primary">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                </svg>
                            </div>
                            <span class="arabic-text">+216 20 987 654</span>
                        </a>

                        <a href="tel:+21692158340" class="flex items-center gap-3 text-muted-foreground hover:text-primary transition-colors">
                            <div class="w-5 h-5 text-primary">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                </svg>
                            </div>
                            <span class="arabic-text">+216 92 158 340</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Quick Links & Social Media --}}
            <div class="space-y-8">
                {{-- Quick Links --}}
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-foreground arabic-heading">روابط مفيدة</h4>
                    <div class="space-y-3">
                        <a href="{{ route('home') }}" class="block text-muted-foreground hover:text-primary transition-colors arabic-text">
                            الرئيسية
                        </a>
                        <a href="{{ route('products.index') }}" class="block text-muted-foreground hover:text-primary transition-colors arabic-text">
                            المنتجات
                        </a>
                    </div>
                </div>

                {{-- Social Media --}}
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-foreground arabic-heading">تابعنا</h4>

                    {{-- Social Icons --}}
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com/profile.php?id=61566967662907" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-primary/10 hover:bg-primary hover:text-background text-primary rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110" aria-label="Follow us on Facebook">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>

                        <a href="https://www.instagram.com/nahlabio_labo/" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-primary/10 hover:bg-primary hover:text-background text-primary rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110" aria-label="Follow us on Instagram">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="mt-12 pt-8 border-t border-border/30">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-muted-foreground arabic-text">
                    © {{ date('Y') }} نهلة. جميع الحقوق محفوظة.
                </p>

                <p class="text-sm text-muted-foreground arabic-text">
                    <a href="https://www.rosa-media.net/" target="_blank" class="text-primary hover:text-primary/80 transition-colors">Rosa Media</a> Powered By <a href="https://stratosdigital.io" target="_blank" class="text-primary hover:text-primary/80 transition-colors">Stratos</a>
                </p>
            </div>
        </div>
    </div>
</footer>
