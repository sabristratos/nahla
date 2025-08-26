@props([
    'count' => '500+',
    'label' => 'عميل راضي',
    'sublabel' => 'يثقون في منتجاتنا الطبيعية',
    'avatars' => [
        ['initial' => 'س', 'color' => 'primary'],
        ['initial' => 'ف', 'color' => 'accent'],
        ['initial' => 'ن', 'color' => 'primary'],
    ],
    'showMore' => true,
])

<div class="flex items-center gap-4">
    <div class="flex -space-x-2" x-data>
        @foreach($avatars as $index => $avatar)
            <div class="w-10 h-10 {{ $avatar['color'] === 'primary' ? 'bg-primary/20' : 'bg-accent/20' }} rounded-full border-2 border-background flex items-center justify-center transform transition-all duration-300"
                 x-data
                 x-init="setTimeout(() => $el.style.transform = 'scale(1) translateY(0)', {{ $index * 100 }})"
                 x-on:mouseenter="$el.style.transform = 'scale(1.15) translateY(-4px)'"
                 x-on:mouseleave="$el.style.transform = 'scale(1) translateY(0)'"
                 style="transform: scale(0.8) translateY(8px)">
                <span class="text-xs font-bold {{ $avatar['color'] === 'primary' ? 'text-primary' : 'text-accent' }}">{{ $avatar['initial'] }}</span>
            </div>
        @endforeach
        @if($showMore)
            <div class="w-10 h-10 bg-muted rounded-full border-2 border-background flex items-center justify-center text-muted-foreground transform transition-all duration-300"
                 x-data
                 x-init="setTimeout(() => $el.style.transform = 'scale(1) translateY(0)', {{ count($avatars) * 100 }})"
                 x-on:mouseenter="$el.style.transform = 'scale(1.15) translateY(-4px)'"
                 x-on:mouseleave="$el.style.transform = 'scale(1) translateY(0)'"
                 style="transform: scale(0.8) translateY(8px)">
                <span class="text-xs">+</span>
            </div>
        @endif
    </div>
    <div>
        <p class="text-sm font-medium arabic-text">أكثر من {{ $count }} {{ $label }}</p>
        @if($sublabel)
            <p class="text-xs text-muted-foreground arabic-text">{{ $sublabel }}</p>
        @endif
    </div>
</div>