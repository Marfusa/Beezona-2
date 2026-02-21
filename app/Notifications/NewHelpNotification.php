<?php

namespace App\Notifications;

use App\Models\Help;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewHelpNotification extends Notification
{
    use Queueable;

    protected $help;

    /**
     * Створюємо новий екземпляр сповіщення та передаємо об'єкт допомоги.
     */
    public function __construct(Help $help)
    {
        $this->help = $help;
    }

    /**
     * Канали доставки: додаємо 'database', щоб сповіщення з'являлися в кабінеті.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Дані, які будуть збережені в таблиці 'notifications' у форматі JSON.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Нова допомога!',
            'help_title' => $this->help->title, // Використовує наш аксесор для мови
            'city' => $this->help->city,
            'category' => $this->help->category,
            'link' => url('/city/' . urlencode(mb_strtolower($this->help->city))),
        ];
    }

    /**
     * Універсальний масив (можна залишити для загальних потреб)
     */
    public function toArray(object $notifiable): array
    {
        return [
            'help_id' => $this->help->id,
            'title' => $this->help->title,
        ];
    }
}