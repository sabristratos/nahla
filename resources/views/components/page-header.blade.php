@props([
    'title' => '',
    'subtitle' => '',
    'breadcrumbs' => [],
    'animate' => true,
])

{{-- Page Header --}}
<div class="border-b border-border/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center" @if($animate) x-reveal="{ direction: 'up', duration: 0.8 }" @endif>
            @if($title)
                <h1 class="text-4xl lg:text-5xl font-bold arabic-heading text-foreground mb-4">
                    {{ $title }}
                </h1>
            @endif
            
            @if($subtitle)
                <p class="text-lg text-muted-foreground arabic-text max-w-3xl mx-auto leading-relaxed">
                    {{ $subtitle }}
                </p>
            @endif

            {{-- Breadcrumbs --}}
            @if(!empty($breadcrumbs))
                <nav class="mt-6">
                    <ol class="flex items-center justify-center gap-2 text-sm">
                        @foreach($breadcrumbs as $index => $breadcrumb)
                            <li>
                                @if(isset($breadcrumb['url']) && $breadcrumb['url'])
                                    <a href="{{ $breadcrumb['url'] }}" class="text-primary hover:text-primary/80 arabic-text">
                                        {{ $breadcrumb['title'] }}
                                    </a>
                                @else
                                    <span class="text-foreground arabic-text">{{ $breadcrumb['title'] }}</span>
                                @endif
                            </li>
                            @if($index < count($breadcrumbs) - 1)
                                <li class="text-muted-foreground">/</li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            @endif
        </div>
    </div>
</div>