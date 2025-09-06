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
        Schema::table('aranzmani', function (Blueprint $table) {
              $table->string('slika')->nullable()->after('opis'); // kolona za putanju slike
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aranzmani', function (Blueprint $table) {
           $table->dropColumn('slika');
        });
    }
};
