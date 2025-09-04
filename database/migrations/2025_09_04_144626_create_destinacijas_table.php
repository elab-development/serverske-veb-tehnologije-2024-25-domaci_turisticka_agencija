<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinacijas', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED
            $table->string('naziv');
            $table->string('drzava');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinacijas');
    }
};
