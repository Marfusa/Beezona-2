<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Створити новину') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 md:p-10">
                    
                    <div class="mb-8 border-b border-gray-100 pb-6">
                        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                            <i class="fa-solid fa-newspaper text-blue-500"></i>
                            Додати нову новину
                        </h1>
                        <p class="text-gray-500 mt-2 text-sm">Заповніть усі необхідні поля для публікації новини.</p>
                    </div>

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

                    <form action="{{ route('admin.news.store') }}" method="POST" class="space-y-8">
                        @csrf

                        {{-- БЛОК 1: Базові налаштування --}}
                        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Категорія</label>
                                <select name="category" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                                    <option value="money">Грошова допомога</option>
                                    <option value="human">Гуманітарна</option>
                                    <option value="med">Медицина</option>
                                    <option value="legal">Юридична</option>
                                    <option value="edu">Освіта</option>
                                    <option value="house">Житло</option>
                                    <option value="psy">Психологія</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Дата публікації <span class="text-red-500">*</span></label>
                                <input type="date" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">URL Зображення</label>
                                <input type="text" name="image" value="{{ old('image') }}" placeholder="https://..." class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                        </div>

                        {{-- БЛОК 2: Джерело (Звідки новина) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Назва джерела (напр. ТСН, Дія)</label>
                                <input type="text" name="source_name" value="{{ old('source_name') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Посилання на першоджерело <span class="text-red-500">*</span></label>
                                <input type="url" name="source_link" value="{{ old('source_link') }}" required placeholder="https://..." class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                        </div>

                        {{-- БЛОК 3: Контент --}}
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Заголовок 🇺🇦 <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Заголовок 🇬🇧</label>
                                    <input type="text" name="title_en" value="{{ old('title_en') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Текст новини 🇺🇦 <span class="text-red-500">*</span></label>
                                    <textarea name="content" rows="6" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none">{{ old('content') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Текст новини 🇬🇧</label>
                                    <textarea name="content_en" rows="6" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none">{{ old('content_en') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex items-center gap-4">
                            <button type="submit" style="background-color: #2563eb; color: #ffffff;" class="px-8 py-3.5 rounded-xl font-semibold hover:opacity-90 transition shadow-md flex items-center gap-2">
                                <i class="fa-solid fa-check" style="color: #ffffff;"></i>
                                <span>Опублікувати новину</span>
                            </button>
                            <a href="{{ route('dashboard') }}" class="px-8 py-3.5 text-gray-500 font-medium hover:bg-gray-100 rounded-xl transition">Скасувати</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>