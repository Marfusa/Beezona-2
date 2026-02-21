<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Підключаємо модель User
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // 1. Беремо всіх користувачів з бази
        $users = User::all();

        // 2. Відкриваємо сторінку і передаємо туди список
        return view('admin.users.index', compact('users'));
    }
}