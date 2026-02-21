<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Керування новинами') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Список усіх новин</h3>
                    <a href="{{ route('admin.news.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        + Додати новину
                    </a>
                </div>
                
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-3 text-left">Заголовок</th>
                            <th class="border p-3 text-left">Дата</th>
                            <th class="border p-3 text-left">Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border p-3">{{ $item->title }}</td>
                            <td class="border p-3">{{ $item->published_at->format('d.m.Y') }}</td>
                            <td class="border p-3">
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Видалити?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Видалити</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>