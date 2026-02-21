<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Результат тесту') }} - Beezona</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        h1, h2, h3, h4, h5, h6 { font-family: 'Montserrat', sans-serif; }
        
        body { 
            margin: 0; padding: 0; font-family: 'Montserrat', sans-serif;
            color: #222; background: linear-gradient(135deg, #fff 0%, #fffbf0 100%);
            /* ГАРАНТІЯ ТОГО, ЩО ФУТЕР БУДЕ ЗНИЗУ */
            min-height: 100vh; 
            display: flex; 
            flex-direction: column;
        }

        /* NAVBAR ЯК НА ГОЛОВНІЙ */
        .navbar { padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .logo { font-weight: 900; font-size: 26px; text-decoration: none; color: #222; display: flex; align-items: center; gap: 8px; }
        .nav-links { display: flex; gap: 30px; align-items: center; }
        .nav-links a { text-decoration: none; color: #555; font-weight: 600; font-size: 15px; transition: 0.3s; }
        .nav-links a:hover { color: #FF9900; }

        .auth-buttons { display: flex; align-items: center; }
        .auth-buttons a { text-decoration: none; color: #222; font-weight: 600; margin-left: 20px; }
        .auth-buttons .btn-reg { background: #222; color: #fff; padding: 10px 24px; border-radius: 30px; }

        /* КАРТКА РЕЗУЛЬТАТУ */
        .result-container { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
        .result-card { background: white; padding: 50px; border-radius: 30px; box-shadow: 0 20px 50px rgba(0,0,0,0.1); text-align: center; max-width: 600px; width: 100%; }
        .score-circle { width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: 900; color: white; margin: 0 auto 30px; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo">🐝 Beezona</a>
        <div class="nav-links">
            <a href="{{ url('/') }}">{{ __('Головна') }}</a>
            <a href="{{ url('/cities') }}">{{ __('Допомога') }}</a>
            <a href="{{ url('/news') }}">{{ __('Новини') }}</a>
            <a href="{{ url('/about') }}">{{ __('Про нас') }}</a>
            <a href="{{ route('guides.index') }}">📚 {{ __('Гайди') }}</a>
            <a href="{{ route('test.index') }}" style="color: #6b21a8;">🧠 {{ __('Тест') }}</a>
            

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

    <main class="result-container">
        <div class="result-card">
            <div class="score-circle bg-{{ $color }}-500">
                {{ $score }}
            </div>
            <h1 class="text-3xl font-bold mb-4">{{ __('Ваш результат') }}</h1>
            <h2 class="text-xl font-semibold text-{{ $color }}-600 mb-6">{{ $result }}</h2>
            <p class="text-gray-600 mb-8 bg-gray-50 p-6 rounded-xl border border-gray-100">{{ $recommendation }}</p>

            <div class="flex flex-col gap-4">
                @if($score > 5)
                    <a href="{{ url('/cities') }}" class="bg-purple-600 text-white font-bold py-3 px-8 rounded-full hover:bg-purple-700 transition shadow-lg">
                        🧠 {{ __('Знайти психолога у своєму місті') }}
                    </a>
                @endif
                <a href="{{ url('/') }}" class="text-gray-500 font-bold hover:text-black">{{ __('Повернутися на головну') }}</a>
            </div>
        </div>
    </main>

    @include('layouts.footer')

</body>
</html>