<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuideController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ПУБЛІЧНА ЧАСТИНА
    |--------------------------------------------------------------------------
    */

    // Відображає список всіх гайдів
    public function index() 
    {
        $guides = Guide::latest()->get();
        return view('guides.index', compact('guides'));
    }

    // Відображає сторінку одного гайду
    public function show($slug) 
    {
        $guide = Guide::where('slug', $slug)->firstOrFail();
        return view('guides.show', compact('guide'));
    }

    /*
    |--------------------------------------------------------------------------
    | АДМІН-ЧАСТИНА
    |--------------------------------------------------------------------------
    */

    // Форма створення
    public function create() 
    {
        return view('admin.guides.create');
    }

    // Збереження нового гайду
    public function store(Request $request) 
    {
        // 1. Правильно перевіряємо масиви для двох мов
        $request->validate([
            'title.uk'             => 'required|string|max:255',
            'title.en'             => 'nullable|string|max:255',
            'category'             => 'required|string',
            'icon'                 => 'nullable|string',
            'short_description.uk' => 'required|string',
            'short_description.en' => 'nullable|string',
            'content.uk'           => 'required|string',
            'content.en'           => 'nullable|string',
        ]);

        // 2. Створюємо унікальний slug (посилання) на основі української назви + час
        $slug = Str::slug($request->input('title.uk')) . '-' . time();

        // 3. Зберігаємо у базу як JSON (масиви)
        Guide::create([
            'title' => [
                'uk' => $request->input('title.uk'),
                'en' => $request->input('title.en') ?? $request->input('title.uk'),
            ],
            'slug'              => $slug, 
            'category'          => $request->category,
            'icon'              => $request->icon ?? 'fa-book',
            'short_description' => [
                'uk' => $request->input('short_description.uk'),
                'en' => $request->input('short_description.en') ?? $request->input('short_description.uk'),
            ],
            'content' => [
                'uk' => $request->input('content.uk'),
                'en' => $request->input('content.en') ?? $request->input('content.uk'),
            ],
        ]);

        // 4. Одразу перекидаємо на сторінку каталогу гайдів
        return redirect()->route('guides.index')->with('success', 'Гайд успішно створено!');
    }

    // Форма редагування
    public function edit($id) 
    {
        $guide = Guide::findOrFail($id);
        return view('admin.guides.edit', compact('guide'));
    }

    // Оновлення даних
    public function update(Request $request, $id) 
    {
        $guide = Guide::findOrFail($id);

        $request->validate([
            'title.uk'             => 'required|string|max:255',
            'title.en'             => 'nullable|string|max:255',
            'category'             => 'required|string',
            'icon'                 => 'nullable|string',
            'short_description.uk' => 'required|string',
            'short_description.en' => 'nullable|string',
            'content.uk'           => 'required|string',
            'content.en'           => 'nullable|string',
        ]);

        $guide->update([
            'title' => [
                'uk' => $request->input('title.uk'),
                'en' => $request->input('title.en') ?? $request->input('title.uk'),
            ],
            // При оновленні зазвичай slug не міняють, щоб не ламалися старі посилання, але можемо оновити:
            'slug'              => Str::slug($request->input('title.uk')) . '-' . $guide->id,
            'category'          => $request->category,
            'icon'              => $request->icon ?? $guide->icon,
            'short_description' => [
                'uk' => $request->input('short_description.uk'),
                'en' => $request->input('short_description.en') ?? $request->input('short_description.uk'),
            ],
            'content' => [
                'uk' => $request->input('content.uk'),
                'en' => $request->input('content.en') ?? $request->input('content.uk'),
            ],
        ]);

        return redirect()->route('guides.index')->with('success', 'Гайд успішно оновлено!');
    }

    // Видалення
    public function destroy($id) 
    {
        $guide = Guide::findOrFail($id);
        $guide->delete();
        
        return redirect()->route('dashboard')->with('success', 'Гайд видалено!');
    }
}