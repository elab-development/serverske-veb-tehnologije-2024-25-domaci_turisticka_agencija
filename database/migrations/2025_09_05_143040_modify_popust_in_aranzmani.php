<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aranzmani', function (Blueprint $table) {
            $table->decimal('popust', 4, 2)->default(0)->change(); 
            // menjamo popust da bude NOT NULL sa default vrednošću 0
        });
    }

    public function down(): void
    {
        Schema::table('aranzmani', function (Blueprint $table) {
            $table->decimal('popust', 5, 2)->nullable()->change(); 
            // vraćamo na staro stanje
        });
    }
};
