<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight italic">
            📩 {{ __('Вхідні запити Beezona') }}
        </h2>
    </x-slot>

    <div class="py-12 text-left">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-8 border border-gray-100">
                <table class="w-full text-left border-separate border-spacing-y-2">
                    <thead>
                        <tr class="text-[10px] font-black uppercase text-gray-400 tracking-widest italic">
                            <th class="px-4">Дата</th>
                            <th class="px-4">Відправник</th>
                            <th class="px-4">Зміст</th>
                            <th class="px-4 text-right">Дія</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $msg)
                            <tr class="bg-gray-50 hover:bg-gray-100 transition rounded-2xl">
                                <td class="px-4 py-4 text-xs font-bold text-gray-400 italic">
                                    {{ $msg->created_at->format('d.m.y') }}
                                </td>
                                <td class="px-4 py-4">
                                    <div class="font-black text-gray-800 italic uppercase tracking-tighter">{{ $msg->name }}</div>
                                    <div class="text-[10px] text-blue-500 font-bold italic">{{ $msg->email }}</div>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-600 italic">
                                    {{ $msg->message }}
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Видалити цей запис?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-gray-400 italic font-medium">Повідомлень поки немає 📫</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>