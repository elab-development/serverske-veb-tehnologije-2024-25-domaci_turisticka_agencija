<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aranzmani', function (Blueprint $table) {
            $table->dropColumn('opis'); // brišemo kolonu opis
        });
    }

    public function down(): void
    {
        Schema::table('aranzmani', function (Blueprint $table) {
            $table->text('opis')->nullable(); // vraćamo kolonu ako se rollbackuje
        });
    }
};
