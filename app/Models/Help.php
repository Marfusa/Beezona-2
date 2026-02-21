<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Help extends Model
{
    use HasFactory;

    protected $fillable = [
        'city', 'category', 'title', 'title_en', 
        'description', 'description_en', 'phone', 
        'address', 'link', 'image', 'latitude', 'longitude'
    ];

    // Автоматичний переклад заголовка
    public function getTitleAttribute($value)
    {
        if (App::getLocale() === 'en' && !empty($this->title_en)) {
            return $this->title_en;
        }
        return $value;
    }

    // Автоматичний переклад опису
    public function getDescriptionAttribute($value)
    {
        if (App::getLocale() === 'en' && !empty($this->description_en)) {
            return $this->description_en;
        }
        return $value;
    }
}