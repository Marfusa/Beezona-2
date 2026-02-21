<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Створюємо акаунт адміністратора
        User::updateOrCreate(
            ['email' => 'admin@beezona.com'], // Перевірка за email
            [
                'name' => 'Admin BeeZona',
                'password' => bcrypt('password123'), // Встановіть надійний пароль
                'role' => 'admin', // Переконайтеся, що у вас є колонка role в таблиці users
            ]
        );

        // Створюємо тестового користувача
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'role' => 'user',
            ]
        );

        // Викликаємо ваші створені сидери для наповнення контентом
        $this->call([
            HelpSeeder::class,
            NewsSeeder::class,
        ]);
    }
}