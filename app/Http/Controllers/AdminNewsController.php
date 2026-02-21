<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class AdminNewsController extends Controller
{
    // Показати список новин
    public function index()
    {
        $news = News::latest()->get();
        return view('dashboard', ['stats' => null]); 
    }

    // Показати форму додавання
    public function create()
    {
        return view('admin.news.create');
    }

        // Зберегти новину з підтримкою англійської мови
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'title_en'     => 'nullable|string|max:255',
            'category'     => 'required|string',
            'content'      => 'required|string',
            'content_en'   => 'nullable|string',
            'image'        => 'nullable|url',       // Змінили на nullable, щоб не блокувало збереження
            'source_name'  => 'nullable|string',
            'source_link'  => 'required|url',       // Зробили обов'язковим, бо новина має мати джерело
            'published_at' => 'required|date',
        ]);


        // Оскільки поля title_en та content_en додані у $fillable моделі News,
        // вони автоматично збережуться в базу даних.
        News::create($data);

        return redirect()->route('dashboard')->with('success', 'Новину успішно додано!');
    }

    // Видалити новину
    public function destroy($id)
    {
        News::destroy($id);
        return redirect()->back()->with('success', 'Новину видалено.');
    }
}