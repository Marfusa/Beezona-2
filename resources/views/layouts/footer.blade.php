<footer class="bg-[#1a1a1a] text-[#ccc] py-12 mt-auto border-t border-[#333] font-sans">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-10">
        
        <div>
            <h3 class="text-3xl font-black text-[#FF9900] mb-4 tracking-tight">Beezona</h3>
            <p class="text-sm leading-relaxed leading-6">
                Платформа соціальної та психологічної підтримки. Ми допомагаємо знайти перевірену інформацію про допомогу у вашому місті.
            </p>
        </div>

        <div>
            <h4 class="text-lg font-bold text-white mb-6 uppercase tracking-wider">Розділи</h4>
            <ul class="space-y-3 text-sm font-medium">
                <li>
                    <a href="{{ url('/') }}" class="hover:text-[#FF9900] transition-colors duration-300 flex items-center gap-3">
                        <i class="fa-solid fa-house-chimney text-[#FF9900]"></i> Головна
                    </a>
                </li>
                <li>
                    <a href="{{ url('/news') }}" class="hover:text-[#FF9900] transition-colors duration-300 flex items-center gap-3">
                        <i class="fa-regular fa-newspaper text-[#FF9900]"></i> Новини
                    </a>
                </li>
                <li>
                    <a href="{{ url('/about') }}" class="hover:text-[#FF9900] transition-colors duration-300 flex items-center gap-3">
                        <i class="fa-solid fa-circle-info text-[#FF9900]"></i> Про нас
                    </a>
                </li>
            </ul>
        </div>

        <div>
            <h4 class="text-lg font-bold text-white mb-6 uppercase tracking-wider">Контакти</h4>
            <ul class="space-y-4 text-sm">
                <li class="flex items-start gap-3">
                    <i class="fa-solid fa-envelope text-[#FF9900] mt-1"></i>
                    <a href="mailto:info@beezona.ua" class="hover:text-white transition-colors duration-300">info@beezona.ua</a>
                </li>
                <li class="flex items-start gap-3">
                    <i class="fa-solid fa-headset text-[#FF9900] mt-1"></i>
                    <span>Працюємо 24/7</span>
                </li>
            </ul>
        </div>

    </div>

    <div class="mt-12 pt-8 border-t border-[#333] text-center text-xs text-[#888]">
        <p>&copy; {{ date('Y') }} Beezona. Всі права захищені.</p>
    </div>
</footer>