<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-black text-gray-800 flex items-center gap-2">
                        🐝 Beezona
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link href="{{ url('/') }}" :active="request()->is('/')">
                        {{ __('Головна') }}
                    </x-nav-link>
                    <x-nav-link href="{{ url('/cities') }}" :active="request()->is('city*')">
                         {{ __('Допомога') }}
                    </x-nav-link>
                    <x-nav-link href="{{ url('/news') }}" :active="request()->is('news*')">
                         {{ __('Новини') }}
                    </x-nav-link>
                    
                    <x-nav-link href="{{ route('guides.index') }}" :active="request()->is('guides*')" class="text-orange-600 font-bold">
                         📚 {{ __('Гайди') }}
                    </x-nav-link>

                    <x-nav-link href="{{ url('/about') }}" :active="request()->is('about*')">
                         {{ __('Про нас') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('test.index') }}" :active="request()->routeIs('test.index')" class="text-purple-600 font-bold">
                         🧠 {{ __('Тест') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex items-center space-x-2 mr-6 text-xs font-bold border-r pr-6 border-gray-200">
                    <a href="{{ route('lang.switch', 'uk') }}" 
                       class="{{ app()->getLocale() == 'uk' ? 'text-orange-500' : 'text-gray-400 hover:text-gray-600' }}">UA</a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('lang.switch', 'en') }}" 
                       class="{{ app()->getLocale() == 'en' ? 'text-orange-500' : 'text-gray-400 hover:text-gray-600' }}">EN</a>
                </div>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')">{{ __('Кабінет') }}</x-dropdown-link>
                            
                            {{-- ПОКАЗУЄМО "МОЇ ПОВІДОМЛЕННЯ" ТІЛЬКИ ЯКЩО ЦЕ НЕ АДМІН --}}
                            @if(auth()->user()->role !== 'admin')
                                <x-dropdown-link :href="route('profile.messages')">{{ __('Мої повідомлення') }}</x-dropdown-link>
                            @endif
                            
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Профіль') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Вихід') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-orange-500 transition">{{ __('Вхід') }}</a>
                        <a href="{{ route('register') }}" class="text-sm bg-gray-900 text-white px-4 py-2 rounded-full font-bold hover:bg-orange-500 transition">{{ __('Реєстрація') }}</a>
                    </div>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ url('/') }}">{{ __('Головна') }}</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ url('/cities') }}">{{ __('Допомога') }}</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ url('/news') }}">{{ __('Новини') }}</x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('guides.index') }}" class="text-orange-600 font-bold">📚 {{ __('Гайди') }}</x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ url('/about') }}">{{ __('Про нас') }}</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('test.index') }}" class="text-purple-600 font-bold">🧠 {{ __('Тест') }}</x-responsive-nav-link>
            
            {{-- МОБІЛЬНЕ ПОСИЛАННЯ ТІЛЬКИ ДЛЯ ЗВИЧАЙНИХ КОРИСТУВАЧІВ --}}
            @auth
                @if(auth()->user()->role !== 'admin')
                    <x-responsive-nav-link :href="route('profile.messages')">{{ __('Мої повідомлення') }}</x-responsive-nav-link>
                @endif
            @endauth
        </div>
    </div>
</nav>
