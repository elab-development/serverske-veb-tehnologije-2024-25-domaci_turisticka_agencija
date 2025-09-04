<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rezervacijas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('aranzman_id')->constrained('aranzmani')->cascadeOnDelete();
            $table->date('datum_rezervacije');
            $table->integer('broj_osoba');
            $table->decimal('ukupna_cena', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rezervacijas');
    }
};
