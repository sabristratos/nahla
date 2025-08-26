@props([
    'stats' => [],
    'columns' => 3,
    'bordered' => false,
    'centered' => true,
])

@php
    $gridClass = match($columns) {
        2 => 'grid-cols-2',
        3 => 'grid-cols-3',
        4 => 'grid-cols-2 md:grid-cols-4',
        default => 'grid-cols-3'
    };
@endphp

<div class="grid {{ $gridClass }} gap-6 {{ $bordered ? 'pt-4 border-t border-border' : '' }}">
    @foreach($stats as $stat)
        <div class="{{ $centered ? 'text-center' : '' }}">
            @if(isset($stat['icon']))
                <div class="mb-2">
                    {!! $stat['icon'] !!}
                </div>
            @endif
            <p class="text-2xl font-bold {{ $centered ? 'text-start' : '' }} text-primary">
                {{ $stat['value'] }}
            </p>
            <p class="text-xs text-muted-foreground arabic-text">
                {{ $stat['label'] }}
            </p>
        </div>
    @endforeach
</div>