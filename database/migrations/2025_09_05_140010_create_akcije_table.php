<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akcije', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->decimal('popust', 5, 2); // npr. 10.50 (%)
            $table->foreignId('aranzman_id')->constrained('aranzmani')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akcije');
    }
};
