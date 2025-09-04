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
    Schema::create('akcije', function (Blueprint $table) {
        $table->id();
        $table->string('naziv');
        $table->integer('popust')->default(0); // popust u procentima
        $table->foreignId('aranzman_id')->constrained('aranzmani')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akcijas');
    }
};
