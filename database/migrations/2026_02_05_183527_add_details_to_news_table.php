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
        Schema::table('news', function (Blueprint $table) {
        $table->string('category')->default('other'); // Наприклад: money, med, edu
        $table->string('source_name')->nullable();    // Назва: ТСН, Дія, МОЗ
        $table->string('source_link')->nullable();    // Посилання: https://...
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            //
        });
    }
};
