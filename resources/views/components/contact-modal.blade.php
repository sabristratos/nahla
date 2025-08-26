{{-- Contact Modal Component --}}
<div x-data="contactModal" class="relative z-[60]">
    {{-- Backdrop --}}
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="close()"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm"
        style="display: none;"
    ></div>

    {{-- Modal --}}
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        @keydown.escape="close()"
        class="fixed inset-0 flex items-center justify-center p-4 pointer-events-none"
        style="display: none;"
    >
        <div @click.stop class="bg-card/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-border/50 w-full max-w-lg max-h-[90vh] overflow-y-auto pointer-events-auto">
            <div class="p-6">
                {{-- Header --}}
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-foreground arabic-heading">
                        تواصل معنا
                    </h3>
                    <button 
                        @click="close()"
                        class="w-8 h-8 rounded-full bg-muted hover:bg-muted/80 flex items-center justify-center transition-colors"
                        aria-label="إغلاق"
                    >
                        <x-icon name="heroicon-o-x-mark" class="w-5 h-5 text-muted-foreground" />
                    </button>
                </div>

                {{-- Contact Options --}}
                <div class="space-y-6">
                    {{-- Phone Numbers --}}
                    <div class="space-y-3">
                        <h4 class="font-semibold text-foreground arabic-text">
                            اتصل بنا مباشرة
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <a href="tel:21526011" 
                               class="flex items-center justify-center gap-3 bg-primary/10 hover:bg-primary hover:text-primary-foreground border border-primary text-primary px-4 py-3 rounded-lg transition-all duration-300 arabic-text">
                                <x-icon name="heroicon-o-phone" class="w-5 h-5" />
                                <span class="font-medium">21.526.011</span>
                            </a>
                            <a href="tel:29082808" 
                               class="flex items-center justify-center gap-3 bg-primary/10 hover:bg-primary hover:text-primary-foreground border border-primary text-primary px-4 py-3 rounded-lg transition-all duration-300 arabic-text">
                                <x-icon name="heroicon-o-phone" class="w-5 h-5" />
                                <span class="font-medium">29.082.808</span>
                            </a>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="flex items-center gap-4">
                        <div class="h-px bg-border flex-1"></div>
                        <span class="text-sm text-muted-foreground arabic-text">أو</span>
                        <div class="h-px bg-border flex-1"></div>
                    </div>

                    {{-- Contact Form --}}
                    <div class="space-y-4">
                        <h4 class="font-semibold text-foreground arabic-text">
                            أرسل لنا رسالة
                        </h4>
                        <form @submit.prevent="submitForm()" class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="contact-name" class="block text-sm font-medium text-foreground arabic-text">
                                        الاسم *
                                    </label>
                                    <input 
                                        type="text" 
                                        id="contact-name"
                                        x-model="form.name"
                                        required
                                        class="w-full px-3 py-2 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 arabic-text text-right"
                                        placeholder="اسمك الكامل"
                                    >
                                </div>
                                <div class="space-y-2">
                                    <label for="contact-phone" class="block text-sm font-medium text-foreground arabic-text">
                                        رقم الهاتف *
                                    </label>
                                    <input 
                                        type="text" 
                                        id="contact-phone"
                                        x-model="form.phone"
                                        required
                                        class="w-full px-3 py-2 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 arabic-text text-right"
                                        placeholder="رقم هاتفك"
                                    >
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label for="contact-email" class="block text-sm font-medium text-foreground arabic-text">
                                    البريد الإلكتروني (اختياري)
                                </label>
                                <input 
                                    type="email" 
                                    id="contact-email"
                                    x-model="form.email"
                                    class="w-full px-3 py-2 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                                    placeholder="بريدك الإلكتروني"
                                >
                            </div>

                            <div class="space-y-2">
                                <label for="contact-message" class="block text-sm font-medium text-foreground arabic-text">
                                    الرسالة *
                                </label>
                                <textarea 
                                    id="contact-message"
                                    x-model="form.message"
                                    required
                                    rows="4"
                                    class="w-full px-3 py-2 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 arabic-text text-right resize-none"
                                    placeholder="اكتب رسالتك هنا..."
                                ></textarea>
                            </div>

                            <button 
                                type="submit"
                                :disabled="submitting"
                                :class="submitting ? 'opacity-50 cursor-not-allowed' : 'hover:bg-primary/90'"
                                class="w-full bg-primary text-primary-foreground px-6 py-3 rounded-lg font-medium arabic-text transition-all duration-300 flex items-center justify-center gap-2"
                            >
                                <template x-if="!submitting">
                                    <span>إرسال الرسالة</span>
                                </template>
                                <template x-if="submitting">
                                    <div class="flex items-center gap-2">
                                        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                                        <span>جاري الإرسال...</span>
                                    </div>
                                </template>
                            </button>
                        </form>
                    </div>

                    {{-- Divider --}}
                    <div class="flex items-center gap-4">
                        <div class="h-px bg-border flex-1"></div>
                        <span class="text-sm text-muted-foreground arabic-text">أو تابعنا</span>
                        <div class="h-px bg-border flex-1"></div>
                    </div>

                    {{-- Social Media Links --}}
                    <div class="flex justify-center gap-4">
                        <a href="https://www.facebook.com/profile.php?id=61566967662907" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="w-12 h-12 bg-primary/10 hover:bg-primary hover:text-primary-foreground text-primary rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-105" 
                           aria-label="تابعنا على فيسبوك">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/nahlabio_labo/" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="w-12 h-12 bg-accent/10 hover:bg-accent hover:text-accent-foreground text-accent rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-105" 
                           aria-label="تابعنا على إنستجرام">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Alpine.js Component Script --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('contactModal', () => ({
        open: false,
        submitting: false,
        form: {
            name: '',
            phone: '',
            email: '',
            message: ''
        },

        init() {
            // Listen for custom events to open modal
            window.addEventListener('open-contact-modal', () => {
                this.openModal();
            });
        },

        openModal() {
            this.open = true;
            // Focus first input after modal opens
            this.$nextTick(() => {
                this.$el.querySelector('#contact-name')?.focus();
            });
        },

        close() {
            this.open = false;
            // Clear form after close animation
            setTimeout(() => {
                this.resetForm();
            }, 200);
        },

        resetForm() {
            this.form = {
                name: '',
                phone: '',
                email: '',
                message: ''
            };
            this.submitting = false;
        },

        async submitForm() {
            this.submitting = true;
            
            try {
                // Simulate form submission - replace with actual API call
                await new Promise(resolve => setTimeout(resolve, 2000));
                
                // Show success message (you can customize this)
                alert('تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.');
                
                this.close();
            } catch (error) {
                console.error('Error submitting form:', error);
                alert('حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.');
            } finally {
                this.submitting = false;
            }
        }
    }));
});

// Global function to trigger modal from anywhere
window.openContactModal = function() {
    document.dispatchEvent(new CustomEvent('open-contact-modal'));
};
</script>