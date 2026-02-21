<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; // <--- Додали цей рядок
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ось тут ми пояснюємо Ларавелю, хто такий "admin"
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}