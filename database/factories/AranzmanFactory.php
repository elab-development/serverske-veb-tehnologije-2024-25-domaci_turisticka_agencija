<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aranzman>
 */
class AranzmanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         'naziv' => $this->faker->sentence(3),
        'opis' => $this->faker->paragraph(),
        'cena' => $this->faker->numberBetween(500, 5000),
        'popust' => $this->faker->numberBetween(0, 30),
        'pocetak' => $this->faker->date(),
        'kraj' => $this->faker->date('+1 week'),
        'broj_mesta' => $this->faker->numberBetween(5, 50),
        'destinacija_id' => \App\Models\Destinacija::factory(),
        'last_minute' => $this->faker->boolean(20),
        ];
    }
}
