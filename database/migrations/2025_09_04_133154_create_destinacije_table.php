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
    Schema::create('aranzmani', function (Blueprint $table) {
        $table->id();
        $table->string('naziv_aranzmana');
        $table->decimal('cena', 10, 2);
        $table->boolean('last_minute')->default(false);
        $table->integer('popust')->default(0);
        $table->foreignId('destinacija_id')->constrained('destinacije')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinacije');
    }
};
