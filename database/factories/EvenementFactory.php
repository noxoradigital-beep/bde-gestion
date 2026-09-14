<?php

namespace Database\Factories;

use App\Models\Evenement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Evenement>
 */
class EvenementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->randomElement([
                'Soirée d\'intégration', 'Tournoi de foot', 'Gala de fin d\'année',
                'Afterwork BDE', 'Journée sportive', 'Barbecue de rentrée',
            ]),
            'date' => $this->faker->dateTimeBetween('-2 months', '+2 months'),
            'lieu' => $this->faker->randomElement(['Toulon', 'La Garde', 'Campus ESGI', null]),
            'description' => $this->faker->optional()->sentence(),
            'capacite' => $this->faker->optional()->numberBetween(20, 150),
        ];
    }
}
