<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Панель адміністратора') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-yellow-500">
                
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 p-8 text-white flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold flex items-center gap-3">
                            <i class="fa-solid fa-hand-holding-heart"></i> Додати допомогу
                        </h1>
                        <p class="text-yellow-100 mt-2 text-sm opacity-90">Створіть картку програми двома мовами.</p>
                    </div>
                    <div class="hidden md:block text-5xl opacity-20">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                </div>

                <div class="p-8">
                    <form action="{{ route('admin.help.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-100">
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-city text-orange-500 mr-1"></i> Місто
                                </label>
                                <select name="city" class="w-full border-yellow-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring focus:ring-yellow-200 transition py-2 px-3 bg-white">
                                    @foreach(['Київ', 'Львів', 'Харків', 'Дніпро', 'Одеса', 'Запоріжжя', 'Вінниця', 'Івано-Франківськ'] as $city)
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-100">
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-layer-group text-orange-500 mr-1"></i> Категорія
                                </label>
                                <select name="category" class="w-full border-yellow-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring focus:ring-yellow-200 transition py-2 px-3 bg-white">
                                    <option value="money">💰 Грошова допомога</option>
                                    <option value="human">📦 Гуманітарна допомога</option>
                                    <option value="psy">🧠 Психологічна / Юридична</option>
                                </select>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-building text-orange-500 mr-1"></i> Назва (UA)
                                </label>
                                <input type="text" name="title" required 
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition py-3 px-4"
                                    placeholder="Напр: Червоний Хрест">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-indigo-700 mb-2">
                                    <i class="fa-solid fa-language text-indigo-500 mr-1"></i> Organization Title (EN)
                                </label>
                                <input type="text" name="title_en" 
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition py-3 px-4"
                                    placeholder="Ex: Red Cross">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-info-circle text-orange-500 mr-1"></i> Опис (UA)
                                </label>
                                <input type="text" name="description" required 
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition py-3 px-4"
                                    placeholder="Що надають? (напр. продукти)">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-indigo-700 mb-2">
                                    <i class="fa-solid fa-align-left text-indigo-500 mr-1"></i> Description (EN)
                                </label>
                                <input type="text" name="description_en" 
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition py-3 px-4"
                                    placeholder="Ex: Food packages">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fa-solid fa-globe text-orange-500 mr-1"></i> Посилання на реєстрацію/сайт
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-400"><i class="fa-solid fa-link"></i></span>
                                </div>
                                <input type="url" name="link" required 
                                    class="w-full pl-10 border-gray-300 rounded-xl shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 transition py-3 px-4"
                                    placeholder="https://...">
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 mt-4 border-t border-gray-100">
                            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-800 font-semibold transition px-4 py-2">
                                Скасувати
                            </a>
                            <button type="submit" class="bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 flex items-center gap-2">
                                <i class="fa-solid fa-check-circle"></i> Зберегти програму
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>