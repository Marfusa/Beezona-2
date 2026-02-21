<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Тест на тривожність') }} - Beezona</title>
    
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
        .navbar { padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-weight: 900; font-size: 26px; text-decoration: none; color: #222; display: flex; align-items: center; gap: 8px; }
        .nav-links { display: flex; gap: 30px; align-items: center; }
        .nav-links a { text-decoration: none; color: #555; font-weight: 600; font-size: 15px; transition: 0.3s; }
        .nav-links a:hover { color: #FF9900; }
        
        .auth-buttons { display: flex; align-items: center; }
        .auth-buttons a { text-decoration: none; color: #222; font-weight: 600; margin-left: 20px; }
        .auth-buttons .btn-reg { background: #222; color: #fff; padding: 10px 24px; border-radius: 30px; }
        .auth-buttons .btn-reg:hover { background: #FF9900; }

        /* Стилі форми */
        .test-container { max-width: 800px; margin: 50px auto; background: #fff; padding: 40px; border-radius: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .question-block { margin-bottom: 30px; border-bottom: 1px dashed #eee; padding-bottom: 20px; }
        .question-title { font-size: 18px; font-weight: 700; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }
        .option-label { display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 8px 0; color: #555; }
        .option-label:hover { color: #FF9900; }
        .submit-btn { background: #6b21a8; color: white; border: none; padding: 15px 40px; font-size: 18px; font-weight: bold; border-radius: 50px; cursor: pointer; width: 100%; transition: 0.3s; }
        .submit-btn:hover { background: #581c87; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(107, 33, 168, 0.3); }
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
            <div style="font-weight: bold; font-size: 14px; color: #ccc; border-right: 1px solid #eee; padding-right: 15px;">
                <a href="{{ route('lang.switch', 'uk') }}" style="text-decoration: none; color: {{ app()->getLocale() == 'uk' ? '#FF9900' : '#ccc' }}">UA</a> | 
                <a href="{{ route('lang.switch', 'en') }}" style="text-decoration: none; color: {{ app()->getLocale() == 'en' ? '#FF9900' : '#ccc' }}">EN</a>
            </div>

            <div class="auth-buttons">
                @auth <a href="{{ url('/dashboard') }}">{{ __('Кабінет') }}</a>
                @else <a href="{{ route('login') }}">{{ __('Вхід') }}</a> <a href="{{ route('register') }}" class="btn-reg">{{ __('Реєстрація') }}</a> @endauth
            </div>
        </div>
    </nav>

    <div class="test-container">
        <h1 class="text-3xl font-black text-center mb-2">{{ __('🧠 Тест на тривожність (GAD-7)') }}</h1>
        <p class="text-center text-gray-500 mb-10">{{ __('Дайте відповідь на 3 прості питання про ваш стан за останні 2 тижні.') }}</p>

        <form action="{{ route('test.submit') }}" method="POST">
            @csrf
            
            <div class="question-block">
                <div class="question-title"><span class="bg-purple-100 text-purple-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">1</span> {{ __('Чи відчували ви нервозність або тривогу?') }}</div>
                <label class="option-label"><input type="radio" name="q1" value="0" required> {{ __('Зовсім ні ') }}</label>
                <label class="option-label"><input type="radio" name="q1" value="1"> {{ __('Кілька днів ') }}</label>
                <label class="option-label"><input type="radio" name="q1" value="2"> {{ __('Більше половини днів ') }}</label>
                <label class="option-label"><input type="radio" name="q1" value="3"> {{ __('Майже щодня ') }}</label>
            </div>

            <div class="question-block">
                <div class="question-title"><span class="bg-purple-100 text-purple-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">2</span> {{ __('Чи не могли ви зупинити хвилювання?') }}</div>
                <label class="option-label"><input type="radio" name="q2" value="0" required> {{ __('Зовсім ні') }}</label>
                <label class="option-label"><input type="radio" name="q2" value="1"> {{ __('Кілька днів') }}</label>
                <label class="option-label"><input type="radio" name="q2" value="2"> {{ __('Більше половини днів') }}</label>
                <label class="option-label"><input type="radio" name="q2" value="3"> {{ __('Майже щодня') }}</label>
            </div>

            <div class="question-block">
                <div class="question-title"><span class="bg-purple-100 text-purple-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">3</span> {{ __('Чи було вам важко розслабитися?') }}</div>
                <label class="option-label"><input type="radio" name="q3" value="0" required> {{ __('Зовсім ні') }}</label>
                <label class="option-label"><input type="radio" name="q3" value="1"> {{ __('Кілька днів') }}</label>
                <label class="option-label"><input type="radio" name="q3" value="2"> {{ __('Більше половини днів') }}</label>
                <label class="option-label"><input type="radio" name="q3" value="3"> {{ __('Майже щодня') }}</label>
            </div>

            <button type="submit" class="submit-btn">{{ __('Отримати результат') }}</button>
        </form>
    </div>

</body>
</html>