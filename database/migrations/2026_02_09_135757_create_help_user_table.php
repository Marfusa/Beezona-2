<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('help_user', function (Blueprint $table) {
        $table->id();
        // Зв'язуємо з користувачем
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        // Зв'язуємо з допомогою
        $table->foreignId('help_id')->constrained()->cascadeOnDelete();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help_user');
    }
};
