<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Вимикаємо автопереклад, щоб JSON-дані відображалися коректно --}}
    <meta name="google" content="notranslate">
    
    {{-- ВИПРАВЛЕНО: Додано localized_title для усунення помилки в заголовку --}}
    <title>{{ $guide->localized_title }} - BeeZona</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #f8f9fa; color: #333; }
        
        /* Стилізація контенту з бази */
        .guide-content h3 { font-weight: 800; font-size: 1.25rem; margin-top: 25px; margin-bottom: 10px; color: #1a202c; }
        .guide-content p { margin-bottom: 15px; line-height: 1.7; color: #4a5568; }
        .guide-content ul { list-style: disc; margin-left: 20px; margin-bottom: 20px; }
        .guide-content li { margin-bottom: 8px; }
        .guide-content b { color: #2d3748; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <div class="max-w-4xl mx-auto w-full pt-10 px-6">
        <a href="{{ route('guides.index') }}" class="text-blue-600 font-bold text-sm hover:underline flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> {{ __('Назад до списку інструкцій') }}
        </a>
    </div>

    <main class="flex-grow max-w-4xl mx-auto w-full py-10 px-6 mb-20">
        <article class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            
            {{-- Шапка гайду --}}
            <div class="bg-orange-400 p-8 text-white">
                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-white/20 p-4 rounded-2xl backdrop-blur-md">
                        <i class="fa-solid {{ $guide->icon }} text-3xl"></i>
                    </div>
                    <span class="bg-white/20 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">
                        {{ $guide->category }}
                    </span>
                </div>
                {{-- ВИПРАВЛЕНО: Додано пропущений знак $ та localized версію --}}
                <h1 class="text-3xl md:text-4xl font-black leading-tight">{{ $guide->localized_title }}</h1>
            </div>

            {{-- Основний текст --}}
            <div class="p-8 md:p-12">
                {{-- ВИПРАВЛЕНО: Використовуємо localized_desc замість масиву --}}
                <div class="mb-8 p-6 bg-blue-50 border-l-4 border-blue-500 rounded-r-2xl italic text-gray-600">
                    {{ $guide->localized_desc }}
                </div>

                <div class="guide-content text-lg text-left">
                    {{-- ВИПРАВЛЕНО: Використовуємо localized_content з вимкненим екрануванням для HTML --}}
                    {!! $guide->localized_content !!}
                </div>

                <hr class="my-10 border-gray-100">

                {{-- Фінальна примітка --}}
                <div class="text-center text-gray-400 text-xs font-medium uppercase tracking-widest">
                    {{ __('Матеріал підготовлено платформою BeeZona') }} • {{ $guide->created_at->format('Y') }}
                </div>
            </div>
        </article>
    </main>

    @include('layouts.footer')

</body>
</html>