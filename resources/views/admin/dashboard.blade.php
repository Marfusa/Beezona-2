<x-app-layout>
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 leading-tight uppercase italic tracking-tighter">
            {{ __('Панель керування') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl relative mb-6 shadow-sm font-bold italic text-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- ========================================== --}}
            {{-- БЛОК АДМІНІСТРАТОРА --}}
            {{-- ========================================== --}}
            @if(auth()->user()->role === 'admin')
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

                    {{-- Графік та Юзери --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="p-8 bg-white rounded-3xl shadow-sm border border-gray-100 h-full">
                            <h3 class="text-lg font-black text-gray-800 mb-8 flex items-center gap-2 uppercase tracking-tighter italic">
                                <i class="fa-solid fa-users-viewfinder text-blue-500"></i> Нові юзери
                            </h3>
                            <ul class="space-y-4">
                                @foreach($stats['latest_users'] ?? [] as $user)
                                    <li class="p-4 bg-gray-50 rounded-2xl flex justify-between items-center group hover:bg-white hover:shadow-sm transition">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center font-black text-blue-600 text-[10px] uppercase">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <span class="font-bold text-gray-700 italic tracking-tight">{{ $user->name }}</span>
                                        </div>
                                        <span class="text-[9px] font-black uppercase text-gray-300 tracking-widest">{{ $user->created_at->format('d.m') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="p-8 bg-white rounded-3xl shadow-sm border border-gray-100 h-full text-center">
                            <h3 class="text-lg font-black text-gray-800 mb-8 flex items-center gap-2 uppercase tracking-tighter italic text-left">
                                <i class="fa-solid fa-chart-pie text-emerald-500"></i> Статистика допомоги
                            </h3>
                            <div style="position: relative; height: 250px; width: 100%;">
                                <canvas id="finalChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            {{-- ========================================== --}}
            {{-- КАБІНЕТ КОРИСТУВАЧА --}}
            {{-- ========================================== --}}
            @else
                <div class="space-y-8">
                    {{-- Шапка привітання --}}
                    <div class="p-10 bg-white rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="text-left w-full">
                            <h1 class="text-3xl font-black text-gray-800 italic tracking-tighter uppercase">Вітаємо, {{ Auth::user()->name }}! 👋</h1>
                            <p class="mt-2 text-gray-600 italic">Ваше місто: <span class="font-bold text-blue-600 underline decoration-2">{{ auth()->user()->city ?? 'Київ' }}</span></p>
                        </div>
                        <a href="{{ url('/cities') }}" 
                           class="shrink-0 bg-blue-600 text-white px-10 py-5 rounded-2xl font-black uppercase text-xs tracking-widest shadow-xl shadow-blue-100 hover:bg-blue-700 hover:scale-105 active:scale-95 transition-all duration-300 border-2 border-blue-800">
                            ЗНАЙТИ ДОПОМОГУ
                        </a>
                    </div>

                    {{-- Сповіщення --}}
                    <div class="p-8 bg-white rounded-[2.5rem] shadow-sm border border-gray-100 text-left">
                        <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center gap-2 uppercase italic tracking-tighter">
                            <i class="fa-solid fa-bell text-yellow-500"></i> {{ __('Нові сповіщення') }}
                        </h3>
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <div class="p-5 mb-4 bg-blue-50 border border-blue-100 rounded-2xl flex flex-col md:flex-row justify-between items-center gap-4 shadow-sm hover:shadow-md transition">
                                <div class="flex items-center gap-4 flex-grow">
                                    <div class="bg-blue-600 p-3 rounded-xl hidden md:block text-white text-xs shadow-lg shadow-blue-200">
                                        <i class="fa-solid fa-hand-holding-heart"></i>
                                    </div>
                                    <div>
                                        <p class="font-black text-blue-900 leading-tight italic uppercase text-sm">{{ $notification->data['help_title'] ?? 'Нова програма' }}</p>
                                        <p class="text-[10px] text-blue-600 font-black uppercase mt-1 tracking-widest italic">📍 {{ $notification->data['city'] ?? 'Вся Україна' }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('notifications.read', $notification->id) }}"
                                   class="shrink-0 bg-white text-blue-600 px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest border-2 border-blue-100 hover:bg-blue-600 hover:text-white hover:border-blue-800 transition shadow-sm">
                                    {{ __('ПЕРЕГЛЯНУТИ') }}
                                </a>
                            </div>
                        @empty
                            <div class="py-12 text-center bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200">
                                <p class="text-gray-400 italic font-medium">Нових сповіщень наразі немає.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Збережені програми --}}
                    <div class="p-8 bg-white rounded-[2.5rem] shadow-sm border border-gray-100 text-left">
                        <h3 class="text-xl font-black text-gray-800 mb-8 flex items-center gap-2 uppercase italic tracking-tighter">
                            <i class="fa-solid fa-heart text-red-500"></i> Мої збережені програми
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @forelse(auth()->user()->favorites ?? [] as $help)
                                <div class="p-6 bg-gray-50 border border-gray-100 rounded-[2.5rem] shadow-sm flex flex-col h-full border-t-4 border-t-blue-500 transition-all hover:shadow-xl hover:-translate-y-1">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="font-black text-gray-800 leading-tight italic uppercase tracking-tighter">{{ $help->title }}</h4>
                                        <form action="{{ route('favorites.toggle', $help->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:scale-125 transition">❤️</button>
                                        </form>
                                    </div>
                                    <p class="text-xs text-gray-500 mb-8 flex-grow italic leading-relaxed">{{ Str::limit($help->description, 90) }}</p>
                                    <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-200">
                                        <span class="text-[9px] font-black text-blue-600 px-3 py-1 bg-white border border-blue-100 rounded-full uppercase italic tracking-widest">{{ $help->city }}</span>
                                        <a href="{{ $help->link }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-100">ВІДКРИТИ →</a>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-16 text-center bg-gray-50 rounded-[2.5rem] border-2 border-dashed border-gray-200">
                                    <p class="text-gray-400 italic">Ви ще не зберегли жодної програми. ❤️</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Скрипт графіків --}}
    @if(auth()->user()->role === 'admin')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('finalChart');
            if (ctx) {
                const chartData = {!! $chartData ?? '[0, 0, 0]' !!};
                const total = chartData.reduce((a, b) => a + b, 0);
                const dataToShow = total > 0 ? chartData : [1];
                const colors = total > 0 ? ['#3b82f6', '#f59e0b', '#10b981'] : ['#e5e7eb'];
                
                new Chart(ctx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: total > 0 ? ['Грошова', 'Гуманітарна', 'Інше'] : ['Немає даних'],
                        datasets: [{
                            data: dataToShow,
                            backgroundColor: colors,
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '75%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { padding: 15, usePointStyle: true, font: { size: 11, weight: 'bold' } }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endif
</x-app-layout>