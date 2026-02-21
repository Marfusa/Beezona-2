<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('helps', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('category');
            $table->string('title');
            $table->text('description');
            
            // Ось ці нові колонки, яких не вистачало:
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('helps');
    }
};