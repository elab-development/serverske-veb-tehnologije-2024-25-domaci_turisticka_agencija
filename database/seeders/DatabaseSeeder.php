<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Destinacija::factory(5)->create();

    // Kreiraj 10 aranžmana
    \App\Models\Aranzman::factory(10)->create();

    // Kreiraj 20 rezervacija
    \App\Models\Rezervacija::factory(20)->create();

        // User::factory(10)->create();

       ser::factory()->create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'role' => 'admin',
]);

User::factory()->count(5)->create([
    'role' => 'korisnik',
]);
    }
}
