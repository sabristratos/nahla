<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="منتجات طبيعية 100% من نهلابيو - زيوت طبيعية، كريمات، ومنتجات العناية الطبيعية">
        <meta name="keywords" content="زيت خروع، منتجات طبيعية، العناية بالبشرة، زبدة الشيا، تونس">
        <meta name="author" content="Nahlabio Laboratoire">

        <title>{{ $title ?? 'نهلابيو - منتجات طبيعية 100%' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-background text-foreground font-sans antialiased min-h-screen">
        {{-- Background with Teal Glow Effect --}}
        <div class="min-h-screen w-full relative">
            {{-- Teal Glow Left --}}
            <div class="absolute inset-0 z-0" 
                 style="background: transparent; 
                        background-image: radial-gradient(circle at top left, color-mix(in srgb, var(--teal-500) 40%, transparent), transparent 60%); 
                        filter: blur(80px); 
                        background-repeat: no-repeat;">
            </div>
            
            {{-- Header Component --}}
            <div class="relative z-10">
                <livewire:header />
            </div>

            {{-- Page Content --}}
            <div class="pt-24 relative z-10">
                {{ $slot }}
            </div>
        </div>

        @livewireScripts
        @strataScripts
    </body>
</html>
