<?php

namespace App\Http\Controllers;

use App\Models\Message; 
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Help;
use App\Models\News;
use App\Models\Guide;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Загальна статистика для дашборду
        $stats = [
            'users'    => User::count(),
            'helps'    => Help::count(),
            'news'     => News::count(),
            'guides'   => Guide::count(),
            'messages' => Message::count(), // Додано лічильник повідомлень
            'latest_users' => User::latest()->take(5)->get(),
        ];

        // 2. Дані для графіка категорій допомоги
        $moneyCount = Help::where('category', 'money')->orWhere('category', 'Грошова')->count();
        $humanCount = Help::where('category', 'human')->orWhere('category', 'Гуманітарна')->count();
        $otherCount = Help::whereNotIn('category', ['money', 'human', 'Грошова', 'Гуманітарна'])->count();

        $chartData = json_encode([$moneyCount, $humanCount, $otherCount]);

        return view('dashboard', compact('stats', 'chartData'));
    }

    /**
     * Список усіх повідомлень від користувачів (НОВЕ)
     */
    public function allMessages()
    {
        // Отримуємо всі повідомлення, спочатку найновіші
        $messages = Message::orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.messages', compact('messages'));
    }

    /**
     * Видалення повідомлення (НОВЕ)
     */
    public function destroyMessage(Message $message)
    {
        $message->delete();
        return back()->with('success', 'Повідомлення видалено успішно.');
    }

    /**
     * Повний список користувачів з пагінацією
     */
    public function allUsers()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users-list', compact('users'));
    }

    /**
     * Перемикання ролі користувача (Admin <-> User)
     */
    public function updateRole(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Ви не можете змінити роль самому собі!');
        }
        
        $user->role = ($user->role === 'admin') ? 'user' : 'admin';
        $user->save();

        return back()->with('success', "Роль користувача {$user->name} змінена на {$user->role}.");
    }

    /**
     * Видалення користувача з системи
     */
    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Ви не можете видалити власну адресу!');
        }

        $user->delete();
        return back()->with('success', 'Користувача успішно видалено з Beezona.');
    }
}