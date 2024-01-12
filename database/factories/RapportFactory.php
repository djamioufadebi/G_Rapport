<?php

namespace Database\Factories;

use App\Models\Activite;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rapport>
 */
class RapportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle' => $this->faker->sentence,
            'contenu' => $this->faker->paragraph,
            'statut' => $this->faker->randomElement(['en attente', 'Validé', 'rejeté']),
            'id_activite' => function () {
                return Activite::inRandomOrder()->first()->id;
            },
            'taux_de_realisation' => $this->faker->randomFloat(2, 0, 100),
            // Génère un nombre décimal entre 0 et 100 avec 2 décimales
            'materiels_utilises' => $this->faker->text,
            'difficultes_rencontrees' => $this->faker->text,
            'solutions_apportees' => $this->faker->text,
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'commentaires' => $this->faker->text,
        ];
    }
}