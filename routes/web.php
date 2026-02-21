<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;       // Головний контролер адмінки
use App\Http\Controllers\AdminNewsController;   // Контролер новин
use App\Http\Controllers\AdminHelpController;   // Контролер допомоги
use App\Http\Controllers\FavoriteController;    // Контролер вибраного (❤️)
use App\Http\Controllers\GuideController;
use App\Http\Controllers\TestController;        
use App\Models\News;
use App\Models\Help;
use App\Models\Message;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| ПУБЛІЧНІ СТОРІНКИ ТА ЛОКАЛІЗАЦІЯ
|--------------------------------------------------------------------------
*/

// Перемикач мови (UK/EN)
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'uk'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});
Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
// Сторінка одного конкретного гайду
Route::get('/guides/{slug}', [GuideController::class, 'show'])->name('guides.show');
// --- МАРШРУТИ ТЕСТУВАННЯ ---
Route::get('/test', [TestController::class, 'index'])->name('test.index');
Route::post('/test', [TestController::class, 'submit'])->name('test.submit');

// --- КОНТАКТНА ФОРМА ---
Route::post('/contact-form', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string'
    ]);
    Message::create($data);
    return redirect()->back()->with('success', 'Дякуємо! Ми отримали ваше повідомлення і скоро відповімо.');
})->name('contact.send');

// --- НОВИНИ ---
Route::get('/news', function () {
    $news = News::orderBy('published_at', 'desc')->get();
    return view('news', ['news' => $news]);
});

// --- МІСТА ---
Route::get('/cities', function () {
    return view('cities');
});

Route::get('/city/{name}', function ($name) {
    $cityName = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
    $helps = Help::where('city', $cityName)->get();

    return view('city', [
        'name' => $cityName,
        'helps' => $helps,
    ]);
});

// --- ПОШУК ---
Route::get('/search', function (Request $request) {
    $query = $request->input('q');
    
    if ($query) {
        $helps = Help::where('title', 'LIKE', "%{$query}%")
                     ->orWhere('description', 'LIKE', "%{$query}%")
                     ->get();
        $title = 'Результати пошуку: ' . $query;
    } else {
        $helps = collect(); 
        $title = 'Введіть запит для пошуку';
    }

    return view('city', [
        'name' => $title,
        'helps' => $helps,
    ]);
})->name('search');


/*
|--------------------------------------------------------------------------
| ОСОБИСТИЙ КАБІНЕТ (DASHBOARD)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| АВТОРИЗОВАНІ КОРИСТУВАЧІ
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Налаштування профілю
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/my-messages', [ProfileController::class, 'userMessages'])->name('profile.messages');
    // Кнопка ❤️ (Додати в обране)
    Route::post('/favorites/{id}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // --- РОЗУМНІ СПОВІЩЕННЯ ---
    Route::get('/notifications/{id}/read', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        $link = $notification->data['link'] ?? route('dashboard');
        return redirect($link);
    })->name('notifications.read');
});

/*
|--------------------------------------------------------------------------
| АДМІН-ПАНЕЛЬ (Тільки для користувачів з роллю 'admin')
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| АДМІН-ПАНЕЛЬ (Тільки для користувачів з роллю 'admin')
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'can:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        // --- КЕРУВАННЯ КОРИСТУВАЧАМИ ---
        Route::get('/users', [AdminController::class, 'allUsers'])->name('users.all');
        Route::patch('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        // --- КЕРУВАННЯ ПОВІДОМЛЕННЯМИ (ДОДАЙТЕ ЦІ РЯДКИ!) ---
        Route::get('/messages', [AdminController::class, 'allMessages'])->name('messages.index');
        Route::delete('/messages/{message}', [AdminController::class, 'destroyMessage'])->name('messages.destroy');

        // Керування новинами
        Route::get('/news', [AdminNewsController::class, 'index'])->name('news.index');
        Route::get('/news/create', [AdminNewsController::class, 'create'])->name('news.create');
        Route::post('/news', [AdminNewsController::class, 'store'])->name('news.store');
        Route::delete('/news/{id}', [AdminNewsController::class, 'destroy'])->name('news.destroy');

        // Керування програмами допомоги
        Route::get('/help/create', [AdminHelpController::class, 'create'])->name('help.create');
        Route::post('/help', [AdminHelpController::class, 'store'])->name('help.store');
        // --- КЕРУВАННЯ ГАЙДАМИ (Додайте це сюди!) ---
Route::get('/guides/create', [GuideController::class, 'create'])->name('guides.create');
Route::post('/guides', [GuideController::class, 'store'])->name('guides.store');
Route::get('/guides/{id}/edit', [GuideController::class, 'edit'])->name('guides.edit');
Route::delete('/guides/{id}', [GuideController::class, 'destroy'])->name('guides.destroy');
    });

require __DIR__.'/auth.php';