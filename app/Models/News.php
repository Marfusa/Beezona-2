<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App; // Додаємо цей імпорт

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_en',    // Додаємо англійський заголовок
        'content',
        'content_en',  // Додаємо англійський контент
        'image',
        'published_at',
        'category',
        'source_name',
        'source_link',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    /**
     * Автоматичний вибір заголовка залежно від мови
     */
    public function getTitleAttribute($value)
    {
        // Якщо мова англійська і у нас є переклад — віддаємо його
        if (App::getLocale() === 'en' && !empty($this->title_en)) {
            return $this->title_en;
        }
        return $value; // Інакше віддаємо стандартний (title)
    }

    /**
     * Автоматичний вибір контенту залежно від мови
     */
    public function getContentAttribute($value)
    {
        if (App::getLocale() === 'en' && !empty($this->content_en)) {
            return $this->content_en;
        }
        return $value;
    }
}