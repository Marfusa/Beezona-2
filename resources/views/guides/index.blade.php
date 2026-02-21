<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Вимикаємо автопереклад браузера, щоб він не ламав JSON-дані --}}
    <meta name="google" content="notranslate">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    
    <title>{{ __('Гайди та інструкції') }} - Beezona</title>

    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    {{-- НАВІГАЦІЯ --}}
    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-20 flex justify-between items-center">
            
            {{-- ЛОГОТИП --}}
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="text-2xl font-black text-gray-800 tracking-tighter uppercase italic flex items-center gap-2">
                    <span class="text-3xl">🐝</span> Beezona
                </a>
            </div>

            {{-- Меню (Центральна частина) --}}
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ url('/') }}" class="font-bold transition {{ request()->is('/') ? 'text-orange-500' : 'text-gray-500 hover:text-orange-500' }}">
                    {{ __('Головна') }}
                </a>
                <a href="{{ url('/cities') }}" class="font-bold transition {{ request()->is('cities*') ? 'text-orange-500' : 'text-gray-500 hover:text-orange-500' }}">
                    {{ __('Допомога') }}
                </a>
                <a href="{{ url('/news') }}" class="font-bold transition {{ request()->is('news*') ? 'text-orange-500' : 'text-gray-500 hover:text-orange-500' }}">
                    {{ __('Новини') }}
                </a>
                <a href="{{ url('/about') }}" class="font-bold transition {{ request()->is('about*') ? 'text-orange-500' : 'text-gray-500 hover:text-orange-500' }}">
                    {{ __('Про нас') }}
                </a>
                <a href="{{ route('test.index') }}" class="font-bold transition flex items-center gap-2 {{ request()->routeIs('test.*') ? 'text-pink-500' : 'text-gray-500 hover:text-pink-500' }}">
                    <span>🧠</span> {{ __('Тест') }}
                </a>
                <a href="{{ route('guides.index') }}" class="font-bold transition flex items-center gap-2 {{ request()->routeIs('guides.*') ? 'text-orange-500' : 'text-gray-500 hover:text-orange-500' }}">
                    <span>📚</span> {{ __('Гайди') }}
                </a>
            </div>

            {{-- ПЕРЕМИКАЧ МОВ ТА КАБІНЕТ --}}
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 font-black text-[10px] uppercase tracking-widest border-r pr-4 border-gray-100">
                    <a href="{{ url('lang/uk') }}" class="{{ app()->getLocale() == 'uk' ? 'text-orange-500' : 'text-gray-300 hover:text-orange-400' }}">UA</a>
                    <span class="text-gray-200">|</span>
                    <a href="{{ url('lang/en') }}" class="{{ app()->getLocale() == 'en' ? 'text-orange-500' : 'text-gray-300 hover:text-orange-400' }}">EN</a>
                </div>
                <a href="{{ route('login') }}" class="font-black text-gray-700 hover:text-orange-500 text-[11px] uppercase tracking-tighter italic flex items-center gap-2">
                    <i class="fa-solid fa-circle-user text-lg"></i>
                    {{ __('Кабінет') }}
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-12 px-4 flex-grow">
        {{-- ЗАГОЛОВОК --}}
        <h1 class="text-4xl font-black text-center mb-16 text-gray-800 uppercase italic tracking-tighter">
            📚 {{ __('КОРИСНІ ІНСТРУКЦІЇ') }}
        </h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($guides as $guide)
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col text-left group">
                    
                    {{-- ПОМАРАНЧЕВА ШАПКА КАРТКИ --}}
                    <div class="bg-orange-400 p-8 text-white relative">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="bg-white/20 p-4 rounded-2xl backdrop-blur-md border border-white/10">
                                <i class="fa-solid {{ $guide->icon ?? 'fa-file-lines' }} text-3xl"></i>
                            </div>
                        </div>

                        <h2 class="text-xl md:text-2xl font-black leading-tight uppercase italic tracking-tighter">
                            {{ $guide->localized_title }}
                        </h2>
                    </div>

                    {{-- КОНТЕНТ КАРТКИ --}}
                    <div class="p-8 flex-grow flex flex-col">
                        <p class="text-gray-500 text-sm mb-10 italic leading-relaxed">
                            {{ Str::limit($guide->localized_desc, 120) }}
                        </p>

                        <div class="mt-auto text-left">
                            <a href="{{ route('guides.show', $guide->slug) }}" 
                               class="inline-block bg-blue-600 text-white px-10 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-100 active:scale-95">
                                {{ __('Читати гайд') }} →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    @include('layouts.footer')

</body>
</html>