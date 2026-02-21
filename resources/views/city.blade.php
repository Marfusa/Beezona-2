<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Допомога') }} - {{ $name }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Montserrat', sans-serif; }
        /* Кастомний градієнт для картки міста */
        .city-card-bg { background: linear-gradient(180deg, #ffffff 0%, #fff9dd 100%); }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ url('/') }}" class="text-2xl font-black text-gray-900 flex items-center gap-2 hover:opacity-80 transition">
                    🐝 Beezona
                </a>

                <div class="hidden md:flex gap-8">
                    <a href="{{ url('/') }}" class="font-bold text-gray-500 hover:text-yellow-500 transition">{{ __('Головна') }}</a>
                    <a href="{{ url('/cities') }}" class="font-bold text-yellow-500">{{ __('Допомога') }}</a>
                    <a href="{{ url('/news') }}" class="font-bold text-gray-500 hover:text-yellow-500 transition">{{ __('Новини') }}</a>
                    <a href="{{ url('/about') }}" class="font-bold text-gray-500 hover:text-yellow-500 transition">{{ __('Про нас') }}</a>
                     <a href="{{ route('test.index') }}"class="font-bold text-gray-500 hover:text-yellow-500 transition">🧠 {{ __('Тест') }}</a>
                        <a href="{{ route('guides.index') }}"class="font-bold text-gray-500 hover:text-yellow-500 transition">📚 {{ __('Гайди') }}</a>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-sm font-bold text-gray-400 mr-2">
                        <a href="{{ route('lang.switch', 'uk') }}" class="{{ app()->getLocale() == 'uk' ? 'text-yellow-500' : 'hover:text-gray-600' }}">UA</a> | 
                        <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'text-yellow-500' : 'hover:text-gray-600' }}">EN</a>
                    </div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2 bg-yellow-400 text-black font-bold rounded-full hover:bg-yellow-500 transition shadow-md text-sm">{{ __('Кабінет') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="font-bold text-gray-900 hover:text-yellow-500">{{ __('Вхід') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow py-12 px-4">
        
        <div class="max-w-6xl mx-auto city-card-bg rounded-3xl shadow-xl p-8 md:p-10 border border-yellow-100">
            
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">
                    {{ __('Допомога у місті') }} <span class="text-yellow-500">{{ __($name) }}</span>
                </h2>
                <p class="text-gray-500 text-lg">
                    {{ __('Тут зібрані перевірені контакти.') }} <br>
                    <span class="text-sm text-yellow-600 font-bold">({{ __('Натисніть на ❤️ біля назви, щоб зберегти') }})</span>
                </p>
            </div>

            <div id="map" class="w-full h-64 md:h-80 rounded-2xl shadow-inner border-4 border-white mb-10 z-0"></div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 h-full">
                    <h3 class="text-xl font-bold text-gray-800 border-b-2 border-yellow-100 pb-3 mb-4 flex items-center gap-2">
                        💰 {{ __('Грошова допомога') }}
                    </h3>
                    @php $moneyHelps = $helps->where('category', 'money'); @endphp
                    
                    @if($moneyHelps->count() > 0)
                        <ul class="space-y-4">
                            @foreach($moneyHelps as $help)
                                <li class="border-b border-dashed border-gray-100 pb-3 last:border-0">
                                    <div class="flex justify-between items-start gap-2">
                                        <a href="{{ $help->link }}" target="_blank" class="text-blue-600 font-bold hover:underline text-lg leading-tight block">
                                            {{ $help->title }}
                                        </a>
                                        @auth
                                            <form action="{{ route('favorites.toggle', $help->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="hover:scale-110 transition">
                                                    @if(auth()->user()->favorites->contains($help->id)) ❤️ @else 🤍 @endif
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="opacity-50 hover:opacity-100">🤍</a>
                                        @endauth
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">{{ $help->description }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400 italic text-sm text-center py-4">{{ __('Поки немає записів.') }}</p>
                    @endif
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 h-full">
                    <h3 class="text-xl font-bold text-gray-800 border-b-2 border-yellow-100 pb-3 mb-4 flex items-center gap-2">
                        📦 {{ __('Гуманітарна допомога') }}
                    </h3>
                    @php $humanHelps = $helps->where('category', 'human'); @endphp
                    
                    @if($humanHelps->count() > 0)
                        <ul class="space-y-4">
                            @foreach($humanHelps as $help)
                                <li class="border-b border-dashed border-gray-100 pb-3 last:border-0">
                                    <div class="flex justify-between items-start gap-2">
                                        <a href="{{ $help->link }}" target="_blank" class="text-blue-600 font-bold hover:underline text-lg leading-tight block">
                                            {{ $help->title }}
                                        </a>
                                        @auth
                                            <form action="{{ route('favorites.toggle', $help->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="hover:scale-110 transition">
                                                    @if(auth()->user()->favorites->contains($help->id)) ❤️ @else 🤍 @endif
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="opacity-50 hover:opacity-100">🤍</a>
                                        @endauth
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">{{ $help->description }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400 italic text-sm text-center py-4">{{ __('Поки немає записів.') }}</p>
                    @endif
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 h-full">
                    <h3 class="text-xl font-bold text-gray-800 border-b-2 border-yellow-100 pb-3 mb-4 flex items-center gap-2">
                        🧠 {{ __('Психологічна / Інша') }}
                    </h3>
                    @php
                        $psyHelps = $helps->filter(function($item) {
                            return $item->category == 'psy' || $item->category == 'legal' || $item->category == 'other';
                        });
                    @endphp
                    
                    @if($psyHelps->count() > 0)
                        <ul class="space-y-4">
                            @foreach($psyHelps as $help)
                                <li class="border-b border-dashed border-gray-100 pb-3 last:border-0">
                                    <div class="flex justify-between items-start gap-2">
                                        <a href="{{ $help->link }}" target="_blank" class="text-blue-600 font-bold hover:underline text-lg leading-tight block">
                                            {{ $help->title }}
                                        </a>
                                        @auth
                                            <form action="{{ route('favorites.toggle', $help->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="hover:scale-110 transition">
                                                    @if(auth()->user()->favorites->contains($help->id)) ❤️ @else 🤍 @endif
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="opacity-50 hover:opacity-100">🤍</a>
                                        @endauth
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">{{ $help->description }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400 italic text-sm text-center py-4">{{ __('Поки немає записів.') }}</p>
                    @endif
                </div>

            </div>

            <div class="text-center mt-12">
                <a href="{{ url('/cities') }}" class="text-gray-400 font-bold hover:text-yellow-600 transition border-b border-dashed border-gray-400 hover:border-yellow-600 pb-1">
                    &larr; {{ __('Обрати інше місто') }}
                </a>
            </div>

        </div>
    </main>

    @include('layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Центр мапи за замовчуванням
            var mapCenter = [50.4501, 30.5234];
            
            // Якщо є допомога з координатами, центруємось на ній
            @if($helps->whereNotNull('latitude')->first())
                mapCenter = [{{ $helps->whereNotNull('latitude')->first()->latitude }}, {{ $helps->whereNotNull('latitude')->first()->longitude }}];
            @endif

            var map = L.map('map').setView(mapCenter, 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            // Маркери
            @foreach($helps as $help)
                @if($help->latitude && $help->longitude)
                    var marker = L.marker([{{ $help->latitude }}, {{ $help->longitude }}]).addTo(map);
                    marker.bindPopup(`
                        <div style="font-family: sans-serif; text-align:center;">
                            <strong style="color: #0056b3; font-size:14px;">{{ $help->title }}</strong><br>
                            <small>{{ $help->description }}</small><br>
                            <a href="{{ $help->link }}" target="_blank" style="color:#d97706; font-weight:bold; font-size:12px; margin-top:5px; display:inline-block;">Детальніше &rarr;</a>
                        </div>
                    `);
                @endif
            @endforeach
        });
    </script>

</body>
</html>