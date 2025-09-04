<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('aranzmani', function (Blueprint $table) {
    $table->id(); // BIGINT UNSIGNED
    $table->string('naziv');
    $table->decimal('cena', 8, 2);
    $table->foreignId('destinacija_id')->constrained('destinacijas')->cascadeOnDelete();
    $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rezervacijas');
    }
};
