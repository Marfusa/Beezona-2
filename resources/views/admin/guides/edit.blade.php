<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редагувати: ') }} {{ $guide->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 text-left">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <form action="{{ route('admin.guides.update', $guide->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Назва гайду</label>
                        <input type="text" name="title" value="{{ $guide->title }}" required class="w-full border-gray-200 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Категорія</label>
                            <input type="text" name="category" value="{{ $guide->category }}" class="w-full border-gray-200 rounded-xl shadow-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Іконка</label>
                            <input type="text" name="icon" value="{{ $guide->icon }}" class="w-full border-gray-200 rounded-xl shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Короткий опис</label>
                        <textarea name="short_description" rows="2" required class="w-full border-gray-200 rounded-xl shadow-sm">{{ $guide->short_description }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Повний зміст</label>
                        <textarea name="content" rows="12" required class="w-full border-gray-200 rounded-xl shadow-sm font-mono text-sm">{{ $guide->content }}</textarea>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="flex-grow bg-blue-600 text-white font-black py-4 rounded-2xl hover:bg-blue-700 transition shadow-lg shadow-blue-200 uppercase tracking-widest text-sm">
                            Оновити дані
                        </button>
                        <a href="{{ route('admin.guides.index') }}" class="py-4 px-8 bg-gray-100 text-gray-500 rounded-2xl font-bold uppercase text-xs flex items-center">Скасувати</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>