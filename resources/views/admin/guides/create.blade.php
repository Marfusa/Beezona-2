<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Створити нову інструкцію') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 md:p-10">
                    
                    {{-- Заголовок форми --}}
                    <div class="mb-8 border-b border-gray-100 pb-6">
                        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                            <i class="fa-solid fa-file-circle-plus text-blue-500"></i>
                            Додати новий гайд
                        </h1>
                        <p class="text-gray-500 mt-2 text-sm">Заповніть інформацію нижче. Поля для англійської мови не є обов'язковими, але рекомендовані для іноземців.</p>
                    </div>

                    {{-- БЛОК ВІДОБРАЖЕННЯ ПОМИЛОК --}}
                    @if ($errors->any())
                        <div class="mb-8 p-6 bg-red-50 border border-red-100 rounded-2xl">
                            <h3 class="text-red-800 font-bold mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-triangle-exclamation"></i> Упс! Виникла помилка:
                            </h3>
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-1 font-medium">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.guides.store') }}" method="POST" class="space-y-8">
                        @csrf

                        {{-- БЛОК 1: Базові налаштування --}}
                        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Категорія</label>
                                <select name="category" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-700 cursor-pointer">
                                    <option value="Соціальна допомога" {{ old('category') == 'Соціальна допомога' ? 'selected' : '' }}>Соціальна допомога</option>
                                    <option value="Житло" {{ old('category') == 'Житло' ? 'selected' : '' }}>Житло</option>
                                    <option value="Гуманітарка" {{ old('category') == 'Гуманітарка' ? 'selected' : '' }}>Гуманітарка</option>
                                    <option value="Гроші" {{ old('category') == 'Гроші' ? 'selected' : '' }}>Гроші</option>
                                    <option value="Безпека" {{ old('category') == 'Безпека' ? 'selected' : '' }}>Безпека</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Іконка (FontAwesome)</label>
                                <input type="text" name="icon" value="{{ old('icon', 'fa-book') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-700">
                            </div>
                        </div>

                        {{-- БЛОК 2: Контент --}}
                        <div class="space-y-6">
                            
                            {{-- НАЗВА --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Назва гайду 🇺🇦 <span class="text-red-500">*</span></label>
                                    <input type="text" name="title[uk]" value="{{ old('title.uk') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-900">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Назва гайду 🇬🇧 <span class="text-gray-400 font-normal text-xs">(Опціонально)</span></label>
                                    <input type="text" name="title[en]" value="{{ old('title.en') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-900">
                                </div>
                            </div>

                            {{-- КОРОТКИЙ ОПИС --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Короткий опис 🇺🇦 <span class="text-red-500">*</span></label>
                                    <textarea name="short_description[uk]" rows="3" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-900">{{ old('short_description.uk') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Короткий опис 🇬🇧 <span class="text-gray-400 font-normal text-xs">(Опціонально)</span></label>
                                    <textarea name="short_description[en]" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-900">{{ old('short_description.en') }}</textarea>
                                </div>
                            </div>

                            {{-- ПОВНИЙ ЗМІСТ --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Повний зміст 🇺🇦 <span class="text-red-500">*</span></label>
                                    <textarea name="content[uk]" rows="10" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-900 font-mono text-sm leading-relaxed">{{ old('content.uk') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Повний зміст 🇬🇧 <span class="text-gray-400 font-normal text-xs">(Опціонально)</span></label>
                                    <textarea name="content[en]" rows="10" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-900 font-mono text-sm leading-relaxed">{{ old('content.en') }}</textarea>
                                </div>
                            </div>

                        </div>

                        {{-- КНОПКИ ДІЙ --}}
                        <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center gap-4">
                            <button type="submit" style="background-color: #2563eb; color: #ffffff;" class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-semibold hover:opacity-90 transition shadow-md flex items-center justify-center gap-2">
                                <i class="fa-solid fa-check" style="color: #ffffff;"></i>
                                <span>Зберегти інструкцію</span>
                            </button>
                            
                            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-3.5 text-center text-gray-500 font-medium hover:bg-gray-100 rounded-xl transition">
                                Скасувати
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>