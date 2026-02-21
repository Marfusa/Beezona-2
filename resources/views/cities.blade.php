<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Оберіть місто') }} - BeeZona</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        h1, h2, h3, h4, h5, h6 { font-family: 'Montserrat', sans-serif; }
        
        body {
            margin: 0; padding: 0; font-family: 'Montserrat', sans-serif;
            color: #222; background: linear-gradient(135deg, #fff 0%, #fffbf0 100%);
            min-height: 100vh; display: flex; flex-direction: column;
        }

        /* NAVBAR */
        .navbar { padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .logo { font-weight: 900; font-size: 26px; text-decoration: none; color: #222; display: flex; align-items: center; gap: 8px; }
        .nav-links { display: flex; gap: 30px; align-items: center; }
        .nav-links a { text-decoration: none; color: #555; font-weight: 600; font-size: 15px; transition: 0.3s; }
        .nav-links a:hover { color: #FF9900; }

        .auth-buttons { display: flex; align-items: center; }
        .auth-buttons a { text-decoration: none; color: #222; font-weight: 600; margin-left: 20px; }
        .auth-buttons .btn-reg { background: #222; color: #fff; padding: 10px 24px; border-radius: 30px; transition: 0.3s; }
        .auth-buttons .btn-reg:hover { background: #FF9900; }

        /* MAIN CONTAINER */
        .main-content { flex: 1; max-width: 1200px; margin: 0 auto; width: 100%; padding: 60px 20px; }

        /* CITY CARDS */
        .city-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 25px;
        }

        .city-card {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            text-decoration: none;
            color: #222;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .city-card i {
            font-size: 32px;
            color: #FF9900;
            transition: 0.3s;
        }

        .city-card:hover {
            transform: translateY(-8px);
            border-color: #FF9900;
            box-shadow: 0 15px 35px rgba(255, 153, 0, 0.15);
        }

        .city-card:hover i {
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .navbar { flex-direction: column; gap: 20px; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo">🐝 Beezona</a>
        <div class="nav-links">
            <a href="{{ url('/') }}">{{ __('Головна') }}</a>
            <a href="{{ url('/cities') }}" style="color:#FF9900">{{ __('Допомога') }}</a>
            <a href="{{ url('/news') }}">{{ __('Новини') }}</a>
            <a href="{{ url('/about') }}">{{ __('Про нас') }}</a>
            <a href="{{ route('test.index') }}" style="color: #6b21a8;">🧠 {{ __('Тест') }}</a>
             <a href="{{ route('guides.index') }}">📚 {{ __('Гайди') }}</a>
        </div>

        <div style="display: flex; align-items: center; gap: 10px;">
            <div style="font-weight: bold; font-size: 14px; color: #ccc;">
                <a href="{{ route('lang.switch', 'uk') }}" style="color: {{ app()->getLocale() == 'uk' ? '#FF9900' : '#ccc' }}">UA</a> | 
                <a href="{{ route('lang.switch', 'en') }}" style="color: {{ app()->getLocale() == 'en' ? '#FF9900' : '#ccc' }}">EN</a>
            </div>
            <div class="auth-buttons">
                @auth
                    <a href="{{ url('/dashboard') }}">{{ __('Кабінет') }}</a>
                @else
                    <a href="{{ route('login') }}">{{ __('Вхід') }}</a>
                    <a href="{{ route('register') }}" class="btn-reg">{{ __('Реєстрація') }}</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="text-center mb-16">
            <h1 class="text-5xl font-black text-gray-800 mb-4">{{ __('Оберіть своє місто') }}</h1>
            <p class="text-xl text-gray-500 font-medium italic">Ми допоможемо знайти підтримку саме там, де ви зараз перебуваєте 🇺🇦</p>
        </div>
        
        <div class="city-grid">
            <a href="{{ url('/city/київ') }}" class="city-card">
                <i class="fa-solid fa-archway"></i>
                {{ __('Київ') }}
            </a>
            <a href="{{ url('/city/львів') }}" class="city-card">
                <i class="fa-solid fa-landmark"></i>
                {{ __('Львів') }}
            </a>
            <a href="{{ url('/city/харків') }}" class="city-card">
                <i class="fa-solid fa-university"></i>
                {{ __('Харків') }}
            </a>
            <a href="{{ url('/city/дніпро') }}" class="city-card">
                <i class="fa-solid fa-bridge"></i>
                {{ __('Дніпро') }}
            </a>
            <a href="{{ url('/city/одеса') }}" class="city-card">
                <i class="fa-solid fa-anchor"></i>
                {{ __('Одеса') }}
            </a>
            <a href="{{ url('/city/запоріжжя') }}" class="city-card">
                <i class="fa-solid fa-bolt"></i>
                {{ __('Запоріжжя') }}
            </a>
            <a href="{{ url('/city/вінниця') }}" class="city-card">
                <i class="fa-solid fa-faucet"></i>
                {{ __('Вінниця') }}
            </a>
            <a href="{{ url('/city/івано-франківськ') }}" class="city-card">
                <i class="fa-solid fa-mountain-sun"></i>
                {{ __('Івано-Франківськ') }}
            </a>
        </div>
    </main>

    @include('layouts.footer')

</body>
</html>