<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aranzmani', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED (auto increment)
            $table->string('naziv');
            $table->text('opis')->nullable(); // kolona koja se kasnije može obrisati
            $table->decimal('cena', 10, 2)->unsigned(); // cena ne može biti negativna
            $table->decimal('popust', 5, 2)->nullable(); // npr. 10.50 (%)
            $table->date('pocetak');
            $table->date('kraj');
            $table->integer('broj_mesta')->unsigned();
            $table->foreignId('destinacija_id')
                  ->constrained('destinacijas')
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aranzmani');
    }
};
