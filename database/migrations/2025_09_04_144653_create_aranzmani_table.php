<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aranzmani', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->text('opis')->nullable();
            $table->decimal('cena', 10, 2)->unsigned();
            $table->decimal('popust', 5, 2)->nullable();
            $table->date('pocetak');
            $table->date('kraj');
            $table->integer('broj_mesta')->unsigned();
            $table->foreignId('destinacija_id')
                  ->constrained('destinacije')
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aranzmani');
    }
};
