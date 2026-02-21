<?php

namespace App\Http\Controllers;

use App\Models\Help;
use App\Models\User; // Додаємо модель User
use App\Notifications\NewHelpNotification; // Додаємо клас сповіщення
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification; // Фасад для масових сповіщень

class AdminHelpController extends Controller
{
    // Показати форму додавання
    public function create()
    {
        return view('admin.help.create');
    }

    // Зберегти допомогу
    public function store(Request $request)
    {
        $data = $request->validate([
            'city' => 'required|string',
            'category' => 'required|string',
            'title' => 'required|string',
            'title_en' => 'nullable|string',
            'description' => 'required|string',
            'description_en' => 'nullable|string',
            'link' => 'required|url',
            // Якщо ви додали поля для карти:
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // 1. Створюємо запис допомоги
        $help = Help::create($data);

       // 2. Отримуємо ВСІХ звичайних користувачів (щоб ніхто не пропустив допомогу)
        $usersToNotify = User::where('role', 'user')->orWhereNull('role')->get();

        // 3. Відправляємо сповіщення
        if ($usersToNotify->count() > 0) {
            Notification::send($usersToNotify, new NewHelpNotification($help));
        }

        return redirect()->route('dashboard')->with('success', 'Програму допомоги додано та сповіщення розіслано!');
    }
}