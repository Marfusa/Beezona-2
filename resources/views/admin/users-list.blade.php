<x-app-layout>
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Керування користувачами BeeZona') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Повідомлення про успіх або помилку --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl shadow-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-2xl shadow-sm">
                    ❌ {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 text-[10px] font-black uppercase text-gray-400 tracking-widest bg-gray-50">
                                <th class="p-4 uppercase tracking-widest">Користувач</th>
                                <th class="p-4 uppercase tracking-widest">Email</th>
                                <th class="p-4 uppercase tracking-widest">Роль</th>
                                <th class="p-4 uppercase tracking-widest">Дата реєстрації</th>
                                <th class="p-4 text-right uppercase tracking-widest">Дії</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($users as $user)
                                <tr class="hover:bg-blue-50/30 transition duration-150">
                                    {{-- Користувач --}}
                                    <td class="p-4 flex items-center gap-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center font-bold text-blue-600 text-xs">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                            <div class="text-[10px] text-gray-400 font-medium">ID: {{ $user->id }}</div>
                                        </div>
                                    </td>

                                    {{-- Email --}}
                                    <td class="p-4 text-gray-600 text-sm italic">{{ $user->email }}</td>

                                    {{-- Роль --}}
                                    <td class="p-4">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter
                                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>

                                    {{-- Дата --}}
                                    <td class="p-4 text-gray-400 text-xs font-bold">
                                        {{ $user->created_at->format('d.m.Y H:i') }}
                                    </td>

                                    {{-- ДІЇ (ОНОВЛЕНО ЗАМІСТЬ ТОЧОК) --}}
                                    <td class="p-4 text-right">
                                        <div class="flex justify-end gap-3">
                                            
                                            {{-- Кнопка зміни ролі --}}
                                            <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="flex items-center gap-2 p-2 px-3 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-xl transition shadow-sm font-bold text-[10px] uppercase" 
                                                        title="Змінити роль">
                                                    <i class="fa-solid fa-user-shield"></i>
                                                    <span>Роль</span>
                                                </button>
                                            </form>

                                            {{-- Кнопка видалення (тільки для інших користувачів) --}}
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                                      onsubmit="return confirm('Ви впевнені, що хочете видалити користувача {{ $user->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="flex items-center gap-2 p-2 px-3 bg-red-50 text-red-500 hover:bg-red-100 rounded-xl transition shadow-sm font-bold text-[10px] uppercase" 
                                                            title="Видалити користувача">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                        <span>Видалити</span>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="p-2 px-3 bg-gray-50 text-gray-300 rounded-xl font-bold text-[10px] uppercase">
                                                    Це ви
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Пагінація --}}
                    <div class="mt-8 px-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>