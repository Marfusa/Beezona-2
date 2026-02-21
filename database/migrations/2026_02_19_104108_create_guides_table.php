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
        Schema::create('guides', function (Blueprint $table) {
        $table->id();
        $table->json('title'); // ЗМІНИЛИ string НА json (або text)
        $table->string('slug')->unique();
        $table->string('category');
        $table->string('icon')->nullable();
        $table->json('short_description'); // Це теж краще зробити json або text
        $table->json('content'); // І це
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guides');
    }
};
