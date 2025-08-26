{{-- Quick Order Modal Component --}}
<div x-data="quickOrderModal" class="relative z-[60]">
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
        <div @click.stop class="bg-card/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-border/50 w-full max-w-2xl max-h-[90vh] overflow-y-auto pointer-events-auto">
            <div class="p-6">
                {{-- Header --}}
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-foreground arabic-heading">
                        طلب سريع
                    </h3>
                    <button 
                        @click="close()"
                        class="w-8 h-8 rounded-full bg-muted hover:bg-muted/80 flex items-center justify-center transition-colors"
                        aria-label="إغلاق"
                    >
                        <x-icon name="heroicon-o-x-mark" class="w-5 h-5 text-muted-foreground" />
                    </button>
                </div>

                {{-- Product Display --}}
                <div class="bg-muted/30 rounded-xl p-4 mb-6" x-show="selectedProduct">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-muted rounded-lg overflow-hidden flex-shrink-0">
                            <template x-if="selectedProduct && selectedProduct.image">
                                <img :src="selectedProduct.image" :alt="selectedProduct.name" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!selectedProduct || !selectedProduct.image">
                                <div class="w-full h-full flex items-center justify-center">
                                    <x-icon name="heroicon-o-photo" class="w-8 h-8 text-muted-foreground" />
                                </div>
                            </template>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold arabic-text text-foreground" x-text="selectedProduct ? selectedProduct.name : ''"></h4>
                            <p class="text-sm text-muted-foreground arabic-text" x-text="selectedProduct ? selectedProduct.size : ''"></p>
                            <p class="text-lg font-bold text-primary mt-1" x-text="selectedProduct ? selectedProduct.price + ' د.ت' : ''"></p>
                        </div>
                    </div>
                </div>

                {{-- Order Form --}}
                <form @submit.prevent="submitOrder()" class="space-y-6">
                    {{-- Quantity Section --}}
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-foreground arabic-text">
                            الكمية
                        </label>
                        <div class="flex items-center gap-3">
                            <button 
                                type="button"
                                @click="quantity = Math.max(1, quantity - 1)"
                                class="w-10 h-10 rounded-lg bg-muted hover:bg-muted/80 flex items-center justify-center transition-colors"
                                :disabled="quantity <= 1"
                                :class="quantity <= 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-destructive hover:text-white'"
                            >
                                <x-icon name="heroicon-o-minus" class="w-5 h-5" />
                            </button>
                            
                            <input 
                                type="number" 
                                x-model="quantity"
                                min="1" 
                                max="99"
                                class="w-20 h-10 text-center bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent font-semibold [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                            />
                            
                            <button 
                                type="button"
                                @click="quantity = Math.min(99, quantity + 1)"
                                class="w-10 h-10 rounded-lg bg-muted hover:bg-primary hover:text-white flex items-center justify-center transition-colors"
                                :disabled="quantity >= 99"
                            >
                                <x-icon name="heroicon-o-plus" class="w-5 h-5" />
                            </button>
                        </div>
                        <p class="text-xs text-muted-foreground arabic-text">الكمية المتاحة: 1-99</p>
                    </div>

                    {{-- Customer Information --}}
                    <div class="space-y-4">
                        <h4 class="font-semibold text-foreground arabic-text">معلومات العميل</h4>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="order-name" class="block text-sm font-medium text-foreground arabic-text">
                                    الاسم الكامل *
                                </label>
                                <input 
                                    type="text" 
                                    id="order-name"
                                    x-model="customerInfo.name"
                                    required
                                    class="w-full px-3 py-2 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 arabic-text text-right"
                                    placeholder="اسمك الكامل"
                                >
                            </div>
                            
                            <div class="space-y-2">
                                <label for="order-phone" class="block text-sm font-medium text-foreground arabic-text">
                                    رقم الهاتف *
                                </label>
                                <input 
                                    type="text" 
                                    id="order-phone"
                                    x-model="customerInfo.phone"
                                    required
                                    class="w-full px-3 py-2 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 arabic-text text-right"
                                    placeholder="رقم هاتفك"
                                >
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="order-address" class="block text-sm font-medium text-foreground arabic-text">
                                العنوان *
                            </label>
                            <textarea 
                                id="order-address"
                                x-model="customerInfo.address"
                                required
                                rows="3"
                                class="w-full px-3 py-2 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 arabic-text text-right resize-none"
                                placeholder="عنوانك الكامل للتوصيل"
                            ></textarea>
                        </div>

                        <div class="space-y-2">
                            <label for="order-notes" class="block text-sm font-medium text-foreground arabic-text">
                                ملاحظات (اختياري)
                            </label>
                            <textarea 
                                id="order-notes"
                                x-model="customerInfo.notes"
                                rows="2"
                                class="w-full px-3 py-2 bg-background border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 arabic-text text-right resize-none"
                                placeholder="أي ملاحظات إضافية"
                            ></textarea>
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="bg-muted/30 rounded-xl p-4 space-y-3">
                        <h4 class="font-semibold text-foreground arabic-text">ملخص الطلب</h4>
                        <div class="flex justify-between items-center">
                            <span class="text-foreground arabic-text">المنتج</span>
                            <span class="font-medium" x-text="selectedProduct ? selectedProduct.name : ''"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-foreground arabic-text">الكمية</span>
                            <span class="font-medium" x-text="quantity"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-foreground arabic-text">السعر الإجمالي</span>
                            <span class="text-lg font-bold text-primary" x-text="calculateTotal() + ' د.ت'"></span>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button 
                        type="submit"
                        :disabled="submitting"
                        :class="submitting ? 'opacity-50 cursor-not-allowed' : 'hover:bg-primary/90'"
                        class="w-full bg-primary text-primary-foreground px-6 py-3 rounded-lg font-medium arabic-text transition-all duration-300 flex items-center justify-center gap-2"
                    >
                        <template x-if="!submitting">
                            <div class="flex items-center gap-2">
                                <x-icon name="heroicon-o-shopping-bag" class="w-5 h-5" />
                                <span>تأكيد الطلب</span>
                            </div>
                        </template>
                        <template x-if="submitting">
                            <div class="flex items-center gap-2">
                                <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                                <span>جاري تأكيد الطلب...</span>
                            </div>
                        </template>
                    </button>

                    {{-- Alternative Contact --}}
                    <div class="text-center pt-4 border-t border-border">
                        <p class="text-sm text-muted-foreground arabic-text mb-3">
                            أو اتصل بنا مباشرة لتأكيد طلبك:
                        </p>
                        <div class="flex flex-col sm:flex-row gap-2 justify-center">
                            <a href="tel:21526011" 
                               class="flex items-center justify-center gap-2 bg-background hover:bg-primary hover:text-primary-foreground border border-primary text-primary px-4 py-2 rounded-lg transition-all duration-300 arabic-text text-sm">
                                <x-icon name="heroicon-o-phone" class="w-4 h-4" />
                                21.526.011
                            </a>
                            <a href="tel:29082808" 
                               class="flex items-center justify-center gap-2 bg-background hover:bg-primary hover:text-primary-foreground border border-primary text-primary px-4 py-2 rounded-lg transition-all duration-300 arabic-text text-sm">
                                <x-icon name="heroicon-o-phone" class="w-4 h-4" />
                                29.082.808
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Alpine.js Component Script --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('quickOrderModal', () => ({
        open: false,
        submitting: false,
        quantity: 1,
        selectedProduct: null,
        customerInfo: {
            name: '',
            phone: '',
            address: '',
            notes: ''
        },

        init() {
            // Listen for custom events to open modal
            window.addEventListener('open-quick-order-modal', (event) => {
                this.openModal(event.detail);
            });
        },

        openModal(product = null) {
            this.selectedProduct = product;
            this.open = true;
            // Focus first input after modal opens
            this.$nextTick(() => {
                this.$el.querySelector('#order-name')?.focus();
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
            this.quantity = 1;
            this.selectedProduct = null;
            this.customerInfo = {
                name: '',
                phone: '',
                address: '',
                notes: ''
            };
            this.submitting = false;
        },

        calculateTotal() {
            if (!this.selectedProduct || !this.selectedProduct.price) return 0;
            return (parseFloat(this.selectedProduct.price) * this.quantity).toFixed(2);
        },

        async submitOrder() {
            this.submitting = true;
            
            try {
                // Prepare order data
                const orderData = {
                    product: this.selectedProduct,
                    quantity: this.quantity,
                    customer: this.customerInfo,
                    total: this.calculateTotal()
                };

                // Simulate form submission - replace with actual API call
                await new Promise(resolve => setTimeout(resolve, 2000));
                
                // Show success message
                alert('تم تأكيد طلبك بنجاح! سنتواصل معك قريباً لتأكيد التفاصيل والتوصيل.');
                
                this.close();
            } catch (error) {
                console.error('Error submitting order:', error);
                alert('حدث خطأ أثناء تأكيد الطلب. يرجى المحاولة مرة أخرى أو الاتصال بنا مباشرة.');
            } finally {
                this.submitting = false;
            }
        }
    }));
});

// Global function to trigger modal from anywhere
window.openQuickOrderModal = function(product) {
    const event = new CustomEvent('open-quick-order-modal', { 
        detail: product 
    });
    window.dispatchEvent(event);
};
</script>