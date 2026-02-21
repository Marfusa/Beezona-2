<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Про нас') }} - Beezona</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Montserrat', sans-serif; }
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
                    <a href="{{ url('/') }}" class="font-semibold text-gray-500 hover:text-yellow-500 transition">{{ __('Головна') }}</a>
                    <a href="{{ url('/cities') }}" class="font-semibold text-gray-500 hover:text-yellow-500 transition">{{ __('Допомога') }}</a>
                    <a href="{{ url('/news') }}" class="font-semibold text-gray-500 hover:text-yellow-500 transition">{{ __('Новини') }}</a>
                    <a href="{{ url('/about') }}" class="font-bold text-yellow-500 border-b-2 border-yellow-500">{{ __('Про нас') }}</a>
                   <a href="{{ route('test.index') }}" class="font-semibold text-gray-500 hover:text-yellow-500 transition">🧠 {{ __('Тест') }}</a>
                        <a href="{{ route('guides.index') }}"class="font-semibold text-gray-500 hover:text-yellow-500 transition">📚 {{ __('Гайди') }}</a>

                <div class="flex items-center gap-4">
                    <div class="text-sm font-bold text-gray-400 mr-2">
                        <a href="{{ route('lang.switch', 'uk') }}" class="{{ app()->getLocale() == 'uk' ? 'text-gray-900' : 'hover:text-gray-600' }}">UA</a>
                        <span class="mx-1">|</span>
                        <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'text-gray-900' : 'hover:text-gray-600' }}">EN</a>
                    </div>
                    
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2 bg-yellow-400 text-black font-bold rounded-full hover:bg-yellow-500 transition shadow-md text-sm">
                            {{ __('Кабінет') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-900 font-bold hover:text-yellow-500 transition text-sm">{{ __('Вхід') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        
        <div class="max-w-3xl mx-auto px-6 py-16 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                {{ __('Про проєкт') }} <span class="text-yellow-500">Beezona</span>
            </h1>
            <p class="text-lg text-gray-600 leading-relaxed">
                {{ __('Ми створили цю платформу, щоб ви могли') }} 
                <span class="font-bold text-gray-900 bg-yellow-100 px-2 rounded">{{ __('швидко та безкоштовно') }}</span> 
                {{ __('знайти реальну допомогу у своєму місті. Жодних складних реєстрацій чи бюрократії.') }}
            </p>
        </div>

        <div class="bg-white py-16 border-y border-gray-100">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 text-center hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        <div class="w-14 h-14 bg-yellow-100 text-2xl flex items-center justify-center rounded-full mx-auto mb-4">🤝</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('Повністю безкоштовно') }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            {{ __('Усі сервіси, контакти фондів та державні програми, зібрані тут, є безоплатними.') }}
                        </p>
                    </div>

                    <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 text-center hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        <div class="w-14 h-14 bg-blue-100 text-2xl flex items-center justify-center rounded-full mx-auto mb-4">🔓</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('Без реєстрації') }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            {{ __('Шукайте інформацію анонімно. Ми не збираємо ваші персональні дані без потреби.') }}
                        </p>
                    </div>

                    <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100 text-center hover:shadow-lg hover:-translate-y-1 transition duration-300">
                        <div class="w-14 h-14 bg-green-100 text-2xl flex items-center justify-center rounded-full mx-auto mb-4">📍</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('Локальна допомога') }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            {{ __('Оберіть своє місто і отримайте список організацій, які працюють саме поруч з вами.') }}
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-6 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('Для кого це?') }}</h2>
                    <div class="space-y-4 text-gray-600 text-lg leading-relaxed">
                        <p>
                            <i class="fa-solid fa-check text-green-500 mr-2"></i> 
                            {{ __('Внутрішньо переміщені особи (ВПО)') }}
                        </p>
                        <p>
                            <i class="fa-solid fa-check text-green-500 mr-2"></i> 
                            {{ __('Сім\'ї з дітьми та багатодітні родини') }}
                        </p>
                        <p>
                            <i class="fa-solid fa-check text-green-500 mr-2"></i> 
                            {{ __('Люди, що втратили житло або роботу') }}
                        </p>
                        <p>
                            <i class="fa-solid fa-check text-green-500 mr-2"></i> 
                            {{ __('Усі, хто потребує психологічної підтримки') }}
                        </p>
                    </div>
                    
                    <div class="mt-8 p-6 bg-blue-50 rounded-xl border border-blue-100">
                        <p class="text-blue-800 text-sm font-medium">
                            <i class="fa-solid fa-circle-info mr-2"></i>
                            {{ __('Наша мета — щоб жодна людина не залишилася сам на сам зі своїми проблемами.') }}
                        </p>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ __('Напишіть нам') }}</h3>
                    <p class="text-gray-500 text-sm mb-6">{{ __('Є питання чи пропозиція? Ми на зв\'язку.') }}</p>

                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm font-bold text-center">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">{{ __('Ваше ім\'я') }}</label>
                            <input type="text" name="name" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-100 outline-none transition" placeholder="Олена" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">{{ __('Email') }}</label>
                            <input type="email" name="email" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-100 outline-none transition" placeholder="email@example.com" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">{{ __('Повідомлення') }}</label>
                            <textarea name="message" rows="3" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-100 outline-none transition" placeholder="..." required></textarea>
                        </div>

                        <button type="submit" class="w-full py-3 bg-gray-900 text-white font-bold rounded-lg hover:bg-yellow-500 hover:text-black transition shadow-lg transform active:scale-95">
                            {{ __('Надіслати') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </main>

    @include('layouts.footer')

</body>
</html>