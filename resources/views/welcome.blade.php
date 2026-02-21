<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Beezona - Welcome') }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        h1, h2, h3, h4, h5, h6 { font-family: 'Montserrat', sans-serif; }
        
        body {
            margin: 0; padding: 0; font-family: 'Montserrat', sans-serif;
            color: #222; overflow-x: hidden;
            background: linear-gradient(135deg, #fff 0%, #fffbf0 100%);
            min-height: 100vh; display: flex; flex-direction: column;
        }

        /* NAVBAR */
        .navbar { padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; background: white; position: sticky; top: 0; z-index: 50; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
        .logo { font-weight: 900; font-size: 26px; text-decoration: none; color: #222; display: flex; align-items: center; gap: 8px; }
        .nav-links { display: flex; gap: 30px; align-items: center; }
        .nav-links a { text-decoration: none; color: #555; font-weight: 600; font-size: 15px; transition: 0.3s; }
        .nav-links a:hover { color: #FF9900; }

        /* HERO SECTION */
        .hero-container { flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 100px 20px; position: relative; }
        .bg-glow { position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(255,153,0,0.08) 0%, rgba(255,255,255,0) 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: -1; }
        .hero-title { font-size: 72px; font-weight: 900; margin: 0 0 20px 0; line-height: 1.1; letter-spacing: -2px; }
        .hero-title span { color: #FF9900; background: linear-gradient(120deg, rgba(255,153,0,0.2) 0%, rgba(255,153,0,0.2) 100%); background-repeat: no-repeat; background-size: 100% 30%; background-position: 0 85%; }
        .hero-desc { font-size: 20px; color: #666; max-width: 600px; margin: 0 auto 50px; line-height: 1.6; }

        .btn-main { display: inline-block; background: #FF9900; color: #fff; padding: 20px 50px; font-size: 18px; font-weight: 700; text-decoration: none; border-radius: 50px; box-shadow: 0 20px 40px rgba(255, 153, 0, 0.3); transition: all 0.3s ease; }
        .btn-main:hover { transform: translateY(-5px); box-shadow: 0 25px 50px rgba(255, 153, 0, 0.4); background: #e68a00; }

        /* GUIDES SECTION */
        .guides-section { padding: 80px 40px; background: white; border-radius: 60px 60px 0 0; }
        .guide-card { background: #fffbf0; border: 1px solid #ffeeba; border-radius: 24px; padding: 30px; transition: 0.3s; height: 100%; display: flex; flex-direction: column; }
        .guide-card:hover { transform: scale(1.02); box-shadow: 0 20px 40px rgba(255,153,0,0.1); border-color: #FF9900; }

        .auth-buttons .btn-reg { background: #222; color: #fff; padding: 10px 24px; border-radius: 30px; font-weight: 600; }
        .auth-buttons .btn-reg:hover { background: #FF9900; }

        @media (max-width: 768px) {
            .hero-title { font-size: 42px; }
            .nav-links { display: none; }
            .guides-section { padding: 40px 20px; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo">🐝 Beezona</a>
        
        <div class="nav-links">
            <a href="{{ url('/') }}" style="color:#FF9900">{{ __('Головна') }}</a>
            <a href="{{ url('/cities') }}">{{ __('Допомога') }}</a>
            <a href="{{ url('/news') }}">{{ __('Новини') }}</a>
            <a href="{{ route('guides.index') }}">📚 {{ __('Гайди') }}</a>
            <a href="{{ url('/about') }}">{{ __('Про нас') }}</a>
            <a href="{{ route('test.index') }}" style="color: #6b21a8;">🧠 {{ __('Тест') }}</a>
        </div>

        <div style="display: flex; align-items: center; gap: 10px;">
            <div style="font-weight: bold; font-size: 14px; color: #ccc; border-right: 1px solid #eee; padding-right: 15px; margin-right: 5px;">
                <a href="{{ route('lang.switch', 'uk') }}" style="text-decoration: none; color: {{ app()->getLocale() == 'uk' ? '#FF9900' : '#ccc' }}">UA</a> | 
                <a href="{{ route('lang.switch', 'en') }}" style="text-decoration: none; color: {{ app()->getLocale() == 'en' ? '#FF9900' : '#ccc' }}">EN</a>
            </div>
            <div class="auth-buttons">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-bold">{{ __('Кабінет') }}</a>
                @else
                    <a href="{{ route('login') }}" class="font-bold mr-4">{{ __('Вхід') }}</a>
                    <a href="{{ route('register') }}" class="btn-reg">{{ __('Реєстрація') }}</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="hero-container">
        <div class="bg-glow"></div>
        <h1 class="hero-title">{{ __('Допомога поруч.') }}<br><span>{{ __('У твоєму місті.') }}</span></h1>
        <p class="hero-desc">
            {{ __('Платформа соціальної та психологічної підтримки.') }} <br>
            {{ __('Знаходьте перевірені фонди, волонтерів та державні програми.') }}
        </p>
        <a href="{{ url('/cities') }}" class="btn-main">{{ __('Знайти допомогу') }}</a>
        
        <div class="flex gap-10 mt-20 opacity-60 font-bold text-sm">
            <div>💰 {{ __('Грошові виплати') }}</div>
            <div>📦 {{ __('Гуманітарна допомога') }}</div>
            <div>🧠 {{ __('Психологічна підтримка') }}</div>
        </div>
    </div>

    <section class="guides-section">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div class="text-left">
                    <h2 class="text-4xl font-black text-gray-800 uppercase tracking-tighter italic">Юридичні та соціальні гайди</h2>
                    <p class="text-gray-500 mt-2 font-medium">Покрокові інструкції для вирішення ваших питань</p>
                </div>
                <a href="{{ route('guides.index') }}" class="text-orange-500 font-black uppercase text-xs tracking-widest border-b-2 border-orange-500 pb-1 hover:text-orange-600">Дивитися всі гайди →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Ми виводимо 3 статичні картки-приклади, які ведуть до розділу --}}
                <div class="guide-card text-left">
                    <div class="w-12 h-12 bg-orange-100 rounded-2xl flex items-center justify-center text-orange-500 text-xl mb-6">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                    </div>
                    <h3 class="text-xl font-black mb-3 text-gray-800">Статус ВПО у "Дії"</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Дізнайтеся, як швидко оформити довідку переселенця та виплати прямо у смартфоні.</p>
                    <a href="{{ url('/guides') }}" class="mt-auto font-bold text-sm text-gray-900 hover:text-orange-500">Читати інструкцію →</a>
                </div>

                <div class="guide-card text-left">
                    <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-500 text-xl mb-6">
                        <i class="fa-solid fa-house-chimney-crack"></i>
                    </div>
                    <h3 class="text-xl font-black mb-3 text-gray-800">єВідновлення</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Покроковий гайд з подання заяви на компенсацію за пошкоджене під час війни майно.</p>
                    <a href="{{ url('/guides') }}" class="mt-auto font-bold text-sm text-gray-900 hover:text-orange-500">Читати інструкцію →</a>
                </div>

                <div class="guide-card text-left">
                    <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-500 text-xl mb-6">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="text-xl font-black mb-3 text-gray-800">Безпека в мережі</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">Проект UNHOOK: як розпізнати вербувальника в Telegram та захистити дитину.</p>
                    <a href="{{ url('/guides') }}" class="mt-auto font-bold text-sm text-gray-900 hover:text-orange-500">Читати інструкцію →</a>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

</body>
</html>