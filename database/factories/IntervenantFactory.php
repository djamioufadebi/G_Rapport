<?php

namespace Database\Factories;

use App\Models\Activite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intervenant>
 */
class IntervenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'contact' => $this->faker->phoneNumber,
            'date_participation' => $this->faker->date,
            'email' => $this->faker->email,
            'adresse' => $this->faker->address,
            'id_activite' => function () {
                return Activite::inRandomOrder()->first()->id;
            },
        ];
    }
}
