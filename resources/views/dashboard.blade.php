<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Панель керування') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Повідомлення про успіх --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl relative mb-8 shadow-sm font-medium text-sm text-left">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(auth()->user()->role === 'admin')
                {{-- ========================================== --}}
                {{-- БЛОК АДМІНІСТРАТОРА --}}
                {{-- ========================================== --}}
                <div class="space-y-8 text-left">
                    <div class="p-8 bg-white rounded-3xl shadow-sm border border-gray-100 flex justify-between items-center">
                        <h1 class="text-3xl font-black text-gray-800 uppercase italic tracking-tighter">Привіт, Адмін! 👋</h1>
                        <a href="{{ url('/') }}" target="_blank" class="text-gray-400 hover:text-blue-600 transition flex items-center gap-2 uppercase text-[10px] font-black tracking-widest">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> На сайт
                        </a>
                    </div>

                    {{-- Статистика --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="bg-white p-6 rounded-3xl border-l-4 border-blue-500 shadow-sm transition hover:scale-105">
                            <div class="text-3xl font-black text-gray-800 italic">{{ $stats['users'] ?? 0 }}</div>
                            <div class="text-[10px] font-black uppercase text-gray-400 tracking-widest mt-1">Користувачів</div>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border-l-4 border-yellow-500 shadow-sm transition hover:scale-105">
                            <div class="text-3xl font-black text-gray-800 italic">{{ $stats['helps'] ?? 0 }}</div>
                            <div class="text-[10px] font-black uppercase text-gray-400 tracking-widest mt-1">Допомоги</div>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border-l-4 border-green-500 shadow-sm transition hover:scale-105">
                            <div class="text-3xl font-black text-gray-800 italic">{{ $stats['news'] ?? 0 }}</div>
                            <div class="text-[10px] font-black uppercase text-gray-400 tracking-widest mt-1">Новин</div>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border-l-4 border-orange-500 shadow-sm transition hover:scale-105">
                            <div class="text-3xl font-black text-gray-800 italic">{{ \App\Models\Guide::count() }}</div>
                            <div class="text-[10px] font-black uppercase text-gray-400 tracking-widest mt-1">Гайдів</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        {{-- СЕКЦІЯ З ДІАГРАМОЮ --}}
                        <div class="p-8 bg-white rounded-3xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-black text-gray-800 mb-8 flex items-center gap-2 uppercase tracking-tighter italic">
                                <i class="fa-solid fa-chart-pie text-emerald-500"></i> Статистика допомоги
                            </h3>
                            <div style="position: relative; height: 300px; width: 100%;">
                                <canvas id="finalChart"></canvas>
                            </div>
                        </div>

                        {{-- Швидкі дії --}}
                        <div class="space-y-4 flex flex-col justify-center">
                            <a href="{{ route('admin.news.create') }}" class="p-6 bg-white border-2 border-dashed border-blue-200 rounded-3xl hover:bg-blue-50 transition flex items-center gap-4 group shadow-sm">
                                <i class="fa-solid fa-newspaper text-2xl text-blue-300 group-hover:text-blue-500 transition"></i>
                                <div class="font-black text-gray-700 uppercase text-[11px] tracking-widest italic">Додати Новину</div>
                            </a>
                            <a href="{{ route('admin.help.create') }}" class="p-6 bg-white border-2 border-dashed border-yellow-200 rounded-3xl hover:bg-yellow-50 transition flex items-center gap-4 group shadow-sm">
                                <i class="fa-solid fa-handshake-angle text-2xl text-yellow-300 group-hover:text-yellow-500 transition"></i>
                                <div class="font-black text-gray-700 uppercase text-[11px] tracking-widest italic">Додати Допомогу</div>
                            </a>
                            <a href="{{ route('admin.guides.create') }}" class="p-6 bg-white border-2 border-dashed border-orange-200 rounded-3xl hover:bg-orange-50 transition flex items-center gap-4 group shadow-sm">
                                <i class="fa-solid fa-file-circle-plus text-2xl text-orange-300 group-hover:text-orange-500 transition"></i>
                                <div class="font-black text-gray-700 uppercase text-[11px] tracking-widest italic">Створити Гайд</div>
                            </a>
                        </div>
                    </div>

                    {{-- ========================================== --}}
                    {{-- НОВИЙ БЛОК: ПОВІДОМЛЕННЯ ВІД КОРИСТУВАЧІВ --}}
                    {{-- ========================================== --}}
                    <div class="p-8 bg-white rounded-3xl shadow-sm border border-gray-100 mt-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-black text-gray-800 flex items-center gap-2 uppercase tracking-tighter italic">
                                <i class="fa-solid fa-envelope-open-text text-purple-500"></i> Повідомлення з сайту
                            </h3>
                            <a href="{{ route('admin.messages.index') }}" class="text-[10px] font-black uppercase text-blue-600 tracking-widest hover:underline">
                                Керувати всіма →
                            </a>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse(\App\Models\Message::latest()->take(10)->get() as $message)
                                <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:bg-white hover:shadow-md transition">
                                    <div class="flex flex-col md:flex-row justify-between md:items-center gap-2 mb-3 border-b border-gray-200 pb-3">
                                        <div>
                                            <span class="font-black text-gray-800 uppercase italic tracking-tighter">{{ $message->name }}</span>
                                            <a href="mailto:{{ $message->email }}" class="text-xs font-bold text-blue-500 ml-2 hover:underline">{{ $message->email }}</a>
                                        </div>
                                        <span class="text-[9px] font-black uppercase text-gray-400 tracking-widest">
                                            {{ $message->created_at->format('d.m.Y H:i') }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 italic leading-relaxed">
                                        "{{ $message->message }}"
                                    </p>
                                </div>
                            @empty
                                <div class="py-8 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                    <p class="text-gray-400 font-medium italic">Повідомлень поки немає.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

            @else
                {{-- ========================================================================= --}}
                {{-- ЧИСТИЙ ТА ОХАЙНИЙ КАБІНЕТ КОРИСТУВАЧА --}}
                {{-- ========================================================================= --}}
                <div class="space-y-10">
                    
                    {{-- ЛОГІКА ВИЗНАЧЕННЯ МІСТА --}}
                    @php
                        $userFavorites = Auth::user()->favorites ?? collect();
                        $detectedCity = $userFavorites->isNotEmpty() 
                            ? $userFavorites->countBy('city')->sortDesc()->keys()->first() 
                            : 'Не обрано';
                    @endphp
                    
                    {{-- ПРИВІТАННЯ ТА КНОПКА ПОШУКУ --}}
                    <div class="bg-gradient-to-r from-blue-50 to-white p-8 md:p-10 rounded-3xl shadow-sm border border-blue-100 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="text-center md:text-left">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                Вітаємо, {{ Auth::user()->name }}! 👋
                            </h1>
                            <p class="text-gray-600 flex items-center justify-center md:justify-start gap-2">
                                Ваше місто:
                                <span class="inline-flex items-center gap-1 bg-white border border-gray-200 px-3 py-1 rounded-full text-sm font-semibold text-gray-700 shadow-sm">
                                    <i class="fa-solid fa-location-dot text-blue-500"></i> {{ $detectedCity }}
                                </span>
                            </p>
                        </div>
                        
                        <a href="{{ url('/cities') }}" 
                           style="background-color: #2563eb; color: #ffffff;"
                           class="px-8 py-3.5 rounded-2xl font-semibold hover:opacity-90 transition shadow-md flex items-center gap-3 whitespace-nowrap">
                            <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
                            <span>Знайти допомогу</span>
                        </a>
                    </div>

                    {{-- НОВІ СПОВІЩЕННЯ --}}
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-5 flex items-center gap-2 px-1">
                            <span class="w-1.5 h-6 bg-yellow-400 rounded-full"></span> Нові сповіщення
                        </h3>
                        
                        <div class="space-y-4">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800">
                                            {{ $notification->data['help_title'] ?? 'Відкрито нову програму підтримки для мешканців вашого регіону' }}
                                        </h4>
                                        <p class="text-sm text-gray-500 mt-1 flex items-center gap-1">
                                            <i class="fa-solid fa-location-dot text-blue-500"></i> {{ $detectedCity !== 'Не обрано' ? $detectedCity : 'Вся Україна' }}
                                        </p>
                                    </div>
                                    
                                    <a href="{{ route('notifications.read', $notification->id) }}" 
                                       style="background-color: #2563eb; color: #ffffff;"
                                       class="px-6 py-2.5 rounded-xl font-medium text-sm hover:opacity-90 transition shadow-sm flex items-center gap-2 whitespace-nowrap">
                                        <i class="fa-solid fa-eye" style="color: #ffffff;"></i> <span>Переглянути</span>
                                    </a>
                                </div>
                            @empty
                                <div class="p-10 text-center bg-white rounded-3xl border border-gray-100 text-gray-400 font-medium">
                                    Наразі нових сповіщень немає
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- МОЇ ЗБЕРЕЖЕНІ ПРОГРАМИ --}}
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-5 flex items-center gap-2 px-1">
                            <span class="w-1.5 h-6 bg-red-500 rounded-full"></span> Мої збережені програми
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse(auth()->user()->favorites ?? [] as $help)
                                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition flex flex-col h-full relative group">
                                    
                                    <div class="flex justify-between items-start mb-4">
                                        <span class="text-xs font-semibold text-blue-700 bg-blue-50 border border-blue-100 px-2 py-1 rounded-md">
                                            {{ $help->category ?? 'Державні виплати' }}
                                        </span>
                                        <form action="{{ route('favorites.toggle', $help->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:scale-110 transition opacity-80 hover:opacity-100" title="Видалити з обраного">❤️</button>
                                        </form>
                                    </div>
                                    
                                    <h4 class="text-lg font-bold text-gray-900 mb-4 leading-snug group-hover:text-blue-600 transition">
                                        {{ $help->title }}
                                    </h4>
                                    
                                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                                        <span class="text-sm text-gray-500 flex items-center gap-1">
                                            <i class="fa-solid fa-location-dot text-blue-500"></i> {{ $help->city }}
                                        </span>
                                        
                                        <a href="{{ $help->link }}" target="_blank" 
                                           style="background-color: #2563eb; color: #ffffff;"
                                           class="px-5 py-2 rounded-lg font-medium text-sm hover:opacity-90 transition shadow-sm flex items-center gap-2">
                                            <span>Відкрити</span> <i class="fa-solid fa-arrow-right text-xs" style="color: #ffffff;"></i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full p-10 text-center bg-white rounded-3xl border border-gray-100 text-gray-400 font-medium">
                                    Список обраного порожній
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- СКРИПТ АДМІНІСТРАТОРА (БЕЗ ЗМІН) --}}
    @if(auth()->user()->role === 'admin')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const canvas = document.getElementById('finalChart');
                
                if (canvas) {
                    const ctx = canvas.getContext('2d');
                    
                    let rawData = @json($chartData ?? [0, 0, 0]);
                    let chartData = typeof rawData === 'string' ? JSON.parse(rawData) : rawData;
                    
                    const total = chartData.reduce((a, b) => Number(a) + Number(b), 0);
                    
                    const dataToShow = total > 0 ? chartData : [1];
                    const colors = total > 0 ? ['#4285F4', '#F4B400', '#0F9D58'] : ['#e2e8f0'];
                    const labelsToShow = total > 0 ? ['Грошова', 'Гуманітарна', 'Інше'] : ['Немає даних'];

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: labelsToShow,
                            datasets: [{
                                data: dataToShow,
                                backgroundColor: colors,
                                borderWidth: 2,
                                borderColor: '#ffffff',
                                hoverOffset: 15
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            plugins: {
                                legend: { 
                                    position: 'right', 
                                    labels: { 
                                        usePointStyle: true, 
                                        padding: 25,
                                        font: { weight: 'bold', size: 13 },
                                        color: '#475569'
                                    } 
                                }
                            }
                        }
                    });
                }
            });
        </script>
    @endif
</x-app-layout>
