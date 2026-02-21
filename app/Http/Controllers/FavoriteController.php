<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Help;

class FavoriteController extends Controller
{
    // Додати або прибрати зі збережених
    public function toggle($id)
    {
        $help = Help::findOrFail($id);
        $user = auth()->user();

        // 1. Метод toggle() сам перевіряє: якщо є - видаляє, якщо немає - додає.
        $user->favorites()->toggle($help->id);

        // ==========================================
        // 2. МАГІЯ ВИЗНАЧЕННЯ МІСТА
        // ==========================================
        $favorites = $user->favorites()->get();

        if ($favorites->count() > 0) {
            // Рахуємо міста і беремо те, яке на першому місці за популярністю
            $topCity = $favorites->countBy('city')->sortDesc()->keys()->first();
            $user->city = $topCity;
        } else {
            // Якщо користувач прибрав усі лайки, очищаємо місто
            $user->city = null;
        }
        
        // Зберігаємо зміни профілю в базу
        $user->save();
        // ==========================================

        return back()->with('success', 'Список вибраного оновлено!');
    }
}