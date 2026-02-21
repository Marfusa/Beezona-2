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
       // Додаємо колонки для Новин
    Schema::table('news', function (Blueprint $table) {
        $table->string('title_en')->nullable()->after('title');
        $table->text('content_en')->nullable()->after('content');
    });

    // Додаємо колонки для Допомоги (Helps)
    Schema::table('helps', function (Blueprint $table) {
        $table->string('title_en')->nullable()->after('title');
        $table->text('description_en')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
