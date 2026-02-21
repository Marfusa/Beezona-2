<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight italic">
            📩 {{ __('Історія моїх звернень') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-8 border border-gray-100">
                <div class="mb-8">
                    <h3 class="text-2xl font-black text-gray-800 tracking-tighter uppercase italic">
                        Ваші повідомлення для Beezona
                    </h3>
                    <p class="text-gray-500 text-sm italic">Тут відображаються всі ваші запити через контактну форму.</p>
                </div>

                <div class="space-y-6">
                    @forelse($messages as $msg)
                        <div class="p-6 bg-gray-50 rounded-2xl border-l-4 border-blue-500 shadow-sm transition hover:shadow-md">
                            <div class="flex justify-between items-center mb-4">
                                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">
                                    Надіслано
                                </span>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">
                                    {{ $msg->created_at->format('d.m.Y H:i') }}
                                </span>
                            </div>
                            <div class="text-gray-700 leading-relaxed italic border-l-2 border-gray-200 pl-4 py-1">
                                "{{ $msg->message }}"
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="text-5xl mb-4">📫</div>
                            <p class="text-gray-400 italic font-medium italic">Ви ще не надсилали нам повідомлень.</p>
                            <a href="{{ url('/') }}#contact" class="mt-4 inline-block text-blue-600 font-black uppercase text-xs hover:underline italic">
                                Написати нам →
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>