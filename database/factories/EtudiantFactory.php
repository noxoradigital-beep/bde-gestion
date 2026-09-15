<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Etudiant>
 */
// Génère de faux étudiants pour les tests et les données de démo (jamais de vraies infos).
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'classe' => $this->faker->randomElement(['B1', 'B2', 'B3', 'M1', 'M2']),
            'option' => $this->faker->randomElement(['Dev', 'Cyber', 'Data', 'Reseaux', null]),
        ];
    }
}
