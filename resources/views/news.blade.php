<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Новини') }} - Beezona</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* ЖОРСТКА ФІКСАЦІЯ ВЕРТИКАЛЬНОЇ СТРУКТУРИ */
        body { 
            margin: 0; 
            font-family: 'Montserrat', sans-serif; 
            background-color: #f8f9fa; 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
        }
        
        /* NAVBAR ЯК НА ВАШОМУ ПЕРШОМУ ЗРАЗКУ */
        .navbar { 
            background: #fff; 
            padding: 15px 5%; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo { font-weight: 800; font-size: 24px; text-decoration: none; color: #222; }
        .nav-links { display: flex; gap: 20px; align-items: center; } 
        .nav-links a { text-decoration: none; color: #555; font-weight: 600; transition: 0.3s; }
        .nav-links a:hover { color: #FF9900; }

        /* ОСНОВНИЙ КОНТЕНТ */
        .main-wrapper { 
            flex: 1; 
            width: 100%; 
            max-width: 1300px; 
            margin: 40px auto; 
            padding: 0 20px; 
            box-sizing: border-box; 
        }

        /* КАРТКИ НОВИН (GRID) */
        .news-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); 
            gap: 30px; 
        }

        .news-card {
            background: #fff; border-radius: 15px; overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; 
            flex-direction: column; height: 100%; transition: 0.3s;
        }
        .news-card:hover { transform: translateY(-5px); }

        .news-img { width: 100%; height: 210px; object-fit: cover; }
        
        .tag { padding: 4px 10px; border-radius: 6px; font-weight: 800; font-size: 11px; text-transform: uppercase; margin-bottom: 12px; width: fit-content; }
        .tag-money { background:#E3FCEF; color:#006644; }
        .tag-psy { background:#f3e8ff; color:#6b21a8; }
        .tag-human { background:#FFF0B3; color:#854d0e; }

        footer { width: 100%; margin-top: auto; } 

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .navbar { flex-direction: column; gap: 15px; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo">🐝 Beezona</a>
        <div class="nav-links">
            <a href="{{ url('/') }}">{{ __('Головна') }}</a>
            <a href="{{ url('/cities') }}">{{ __('Допомога') }}</a>
            <a href="{{ url('/news') }}" style="color:#FF9900">{{ __('Новини') }}</a>
            <a href="{{ url('/about') }}">{{ __('Про нас') }}</a>
            <a href="{{ route('test.index') }}" style="color: #6b21a8;">🧠 {{ __('Тест') }}</a>
             <a href="{{ route('guides.index') }}">📚 {{ __('Гайди') }}</a>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-sm font-bold text-gray-400">
                <a href="{{ route('lang.switch', 'uk') }}" class="{{ app()->getLocale() == 'uk' ? 'text-orange-500' : '' }}">UA</a> | 
                <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'text-orange-500' : '' }}">EN</a>
            </div>
            @auth 
                <a href="{{ url('/dashboard') }}" class="font-bold text-gray-700">{{ __('Кабінет') }}</a> 
            @else 
                <a href="{{ route('login') }}" class="font-bold text-gray-700">{{ __('Вхід') }}</a> 
            @endauth
        </div>
    </nav>

    <div class="main-wrapper">
        <h1 class="text-3xl font-black text-center mb-10 text-gray-800">
             <i class="fa-regular fa-newspaper text-yellow-500"></i> {{ __('Новини про соціальну допомогу') }}
        </h1>

        <div class="news-grid">
            @forelse($news as $item)
                <div class="news-card">
                    @php
                        // Виправлення битих картинок
                        $src = str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image);
                    @endphp
                    <img src="{{ $src }}" class="news-img" onerror="this.src='https://via.placeholder.com/400x250?text=BeeZona'">
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex justify-between items-center mb-3">
                            <span class="tag tag-{{ $item->category }}">
                                {{ __($item->category) }}
                            </span>
                            
                            {{-- ВИПРАВЛЕНО: Тепер беремо правильну дату публікації! --}}
                            <span class="text-xs text-gray-400 font-bold">
                                {{ \Carbon\Carbon::parse($item->published_at)->format('d.m.Y') }}
                            </span>
                        </div>
                        
                        {{-- ВИПРАВЛЕНО: Автоматичний переклад Заголовку --}}
                        <h3 class="text-xl font-bold mb-3 leading-tight text-gray-900">
                            {{ app()->getLocale() == 'en' && $item->title_en ? $item->title_en : $item->title }}
                        </h3>
                        
                        {{-- ВИПРАВЛЕНО: Автоматичний переклад Тексту --}}
                        <p class="text-gray-500 text-sm mb-5 flex-grow line-clamp-3">
                            {{ Str::limit(app()->getLocale() == 'en' && $item->content_en ? $item->content_en : ($item->description ?? $item->content), 115) }}
                        </p>
                        
                        <a href="{{ $item->link ?? $item->source_link ?? '#' }}" target="_blank" class="mt-auto text-blue-600 font-bold text-sm hover:underline">
                            {{ __('Читати джерело') }} &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-gray-400 font-bold">
                    {{ __('На жаль, новин поки немає.') }}
                </div>
            @endforelse
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>