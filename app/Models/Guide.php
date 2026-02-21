<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    // Вказуємо, які поля можна зберігати
    protected $fillable = [
        'title', 
        'slug', 
        'category', 
        'icon', 
        'short_description', 
        'content'
    ];

    // ВАЖЛИВО: Вказуємо Laravel, що ці поля є масивами (JSON)
    protected $casts = [
        'title'             => 'array',
        'short_description' => 'array',
        'content'           => 'array',
    ];

    // Універсальний метод для виводу тексту потрібною мовою
    private function getLocalized($field)
    {
        $value = $this->getAttribute($field);

        if (is_array($value)) {
            $locale = app()->getLocale();
            return $value[$locale] ?? $value['uk'] ?? current($value);
        }

        return $value;
    }

    // Геттери для Blade
    public function getLocalizedTitleAttribute() { return $this->getLocalized('title'); }
    public function getLocalizedDescAttribute() { return $this->getLocalized('short_description'); }
    public function getLocalizedContentAttribute() { return $this->getLocalized('content'); }
}