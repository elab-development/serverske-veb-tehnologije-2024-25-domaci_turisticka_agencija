<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rezervacija>
 */
class RezervacijaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         'aranzman_id' => \App\Models\Aranzman::factory(),
        'ime' => $this->faker->firstName(),
        'prezime' => $this->faker->lastName(),
        'email' => $this->faker->safeEmail(),
        'broj_osoba' => $this->faker->numberBetween(1, 5),
        ];
    }
}
