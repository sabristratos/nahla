<div>
    {{-- Success Overlay --}}
    @if($orderComplete)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
             x-data="{ 
                show: true,
                init() {
                    setTimeout(() => {
                        $wire.redirectToHome();
                    }, 3000);
                }
             }"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100">
            <div class="bg-background max-w-md mx-4 p-8 rounded-2xl shadow-2xl text-center"
                 x-transition:enter="transition ease-out duration-300 delay-150"
                 x-transition:enter-start="transform scale-95 opacity-0"
                 x-transition:enter-end="transform scale-100 opacity-100">
                
                <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                    <x-icon name="heroicon-o-check-circle" class="w-8 h-8 text-green-600" />
                </div>
                
                <h2 class="text-2xl font-bold text-foreground mb-4 arabic-text text-center">
                    تم إرسال طلبك بنجاح!
                </h2>
                
                <p class="text-muted-foreground arabic-text mb-6">
                    سنتواصل معك قريباً لتأكيد الطلب وتفاصيل التوصيل
                </p>
                
                <div class="flex items-center justify-center space-x-2">
                    <span class="text-sm text-muted-foreground arabic-text">جارٍ العودة للصفحة الرئيسية</span>
                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-primary"></div>
                </div>
            </div>
        </div>
    @endif

    {{-- Page Header --}}
    <x-page-header
        title="إتمام الطلب"
        subtitle="أكمل معلومات الطلب لإتمام عملية الشراء"
        :breadcrumbs="[
            ['title' => 'الرئيسية', 'url' => route('home')],
            ['title' => 'المنتجات', 'url' => route('products.index')],
            ['title' => 'الدفع', 'url' => null]
        ]"
    />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Order Summary Info --}}
        <div class="mb-8 text-center">
            <div class="flex items-center justify-center space-x-4 text-sm text-muted-foreground">
                <span class="arabic-text">{{ $this->itemCount }} منتج</span>
                <span>•</span>
                <span class="font-semibold text-primary">{{ $this->formattedCartTotal }}</span>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            {{-- Order Summary --}}
            <div class="order-2 lg:order-1">
                <x-strata::card>
                    <x-slot name="header">
                        <h2 class="text-xl font-semibold arabic-text">ملخص الطلب</h2>
                    </x-slot>

                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex items-center gap-4 p-3 bg-muted/50 rounded-lg">
                                {{-- Product Image --}}
                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-muted flex-shrink-0">
                                    @if($item['image_path'])
                                        <img
                                            src="{{ asset('storage/' . $item['image_path']) }}"
                                            alt="{{ $item['name_ar'] }}"
                                            class="w-full h-full object-cover"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <x-icon name="heroicon-o-photo" class="w-6 h-6 text-muted-foreground" />
                                        </div>
                                    @endif
                                </div>

                                {{-- Product Info --}}
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-sm arabic-text text-foreground truncate">
                                        {{ $item['name_ar'] }}
                                    </h4>
                                    @if($item['size'])
                                        <p class="text-xs text-muted-foreground arabic-text">
                                            {{ $item['size'] }}
                                        </p>
                                    @endif
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-sm text-muted-foreground arabic-text">
                                            الكمية: {{ $item['quantity'] }}
                                        </span>
                                        <span class="text-sm font-semibold text-primary">
                                            {{ number_format($item['price'] * $item['quantity'], 2) }} د.ت
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Total --}}
                        <div class="border-t border-border pt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-semibold arabic-text">المجموع الكلي:</span>
                                <span class="text-xl font-bold text-primary">{{ $this->formattedCartTotal }}</span>
                            </div>
                        </div>
                    </div>
                </x-strata::card>
            </div>

            {{-- Checkout Form --}}
            <div class="order-1 lg:order-2">
                <h2 class="text-xl font-semibold arabic-text mb-6">بيانات العميل</h2>

                <form wire:submit="processCheckout" class="space-y-6">
                    {{-- Customer Name --}}
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-foreground arabic-text mb-2">
                            الاسم الكامل <span class="text-destructive">*</span>
                        </label>
                        <x-strata::form.input
                            wire:model="customer_name"
                            id="customer_name"
                            name="customer_name"
                            type="text"
                            placeholder="أدخل اسمك الكامل"
                            icon="heroicon-o-user"
                            autocomplete="name"
                        />
                        @error('customer_name')
                            <p class="mt-1 text-sm text-destructive arabic-text">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Customer Phone --}}
                    <div>
                        <label for="customer_phone" class="block text-sm font-medium text-foreground arabic-text mb-2">
                            رقم الهاتف <span class="text-destructive">*</span>
                        </label>
                        <x-strata::form.input
                            wire:model="customer_phone"
                            id="customer_phone"
                            name="customer_phone"
                            type="text"
                            placeholder="أدخل رقم الهاتف"
                            icon="heroicon-o-phone"
                            autocomplete="tel"
                        />
                        @error('customer_phone')
                            <p class="mt-1 text-sm text-destructive arabic-text">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Customer Email --}}
                    <div>
                        <label for="customer_email" class="block text-sm font-medium text-foreground arabic-text mb-2">
                            البريد الإلكتروني <span class="text-destructive">*</span>
                        </label>
                        <x-strata::form.input
                            wire:model="customer_email"
                            id="customer_email"
                            name="customer_email"
                            type="email"
                            placeholder="name@example.com"
                            icon="heroicon-o-envelope"
                            autocomplete="email"
                        />
                        @error('customer_email')
                            <p class="mt-1 text-sm text-destructive arabic-text">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Customer Address --}}
                    <div>
                        <label for="customer_address" class="block text-sm font-medium text-foreground arabic-text mb-2">
                            عنوان التوصيل <span class="text-destructive">*</span>
                        </label>
                        <x-strata::form.textarea
                            wire:model="customer_address"
                            id="customer_address"
                            name="customer_address"
                            rows="3"
                            placeholder="أدخل عنوانك الكامل مع تفاصيل الشارع والمنطقة والمدينة"
                            autocomplete="street-address"
                        />
                        @error('customer_address')
                            <p class="mt-1 text-sm text-destructive arabic-text">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label for="notes" class="block text-sm font-medium text-foreground arabic-text mb-2">
                            ملاحظات إضافية
                        </label>
                        <x-strata::form.textarea
                            wire:model="notes"
                            id="notes"
                            name="notes"
                            rows="2"
                            placeholder="أي ملاحظات أو طلبات خاصة (اختياري)"
                        />
                        @error('notes')
                            <p class="mt-1 text-sm text-destructive arabic-text">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-6 border-t border-border space-y-4">
                        {{-- Confirm Order Button --}}
                        <x-strata::button
                            type="submit"
                            variant="primary"
                            size="lg"
                            class="w-full"
                            :loading="$isProcessing"
                            :disabled="$isProcessing"
                            icon="heroicon-o-check-circle"
                            iconPosition="right"
                        >
                            @if($isProcessing)
                                جارٍ معالجة الطلب...
                            @else
                                تأكيد الطلب وإرساله
                            @endif
                        </x-strata::button>

                        {{-- Back to Shopping --}}
                        <x-strata::button
                            href="/"
                            variant="outline"
                            class="w-full"
                            icon="heroicon-o-arrow-right"
                            iconPosition="right"
                        >
                            العودة للتسوق
                        </x-strata::button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Error Messages --}}
    @if(session('checkout-error'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            x-init="setTimeout(() => show = false, 5000)"
            class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 max-w-md"
        >
            <x-strata::alert color="destructive" dismissible>
                {{ session('checkout-error') }}
            </x-strata::alert>
        </div>
    @endif
</div>
