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
            'statut' => $this->faker->randomElement(['en attente', 'Validé', 'rejeté']),
            'materiels_utilises' => $this->faker->paragraph,
            'difficultes_rencontrees' => $this->faker->paragraph,
            'solutions_apportees' => $this->faker->paragraph,
            'heure_demarrage' => $this->faker->time,
            'heure_fin' => $this->faker->time,
            'travaux_prevus_journee' => $this->faker->paragraph,
            'travaux_realises' => $this->faker->paragraph,
            'travaux_restants' => $this->faker->paragraph,
            'travaux_prevus_demain' => $this->faker->paragraph,
            'besoins_materiaux' => $this->faker->paragraph,
            'id_activite' => function () {
                return Activite::inRandomOrder()->first()->id;
            },
            'user_id' => function () {
                return User::where('id_profil', 2)->inRandomOrder()->first()->id;
            },
            'commentaires' => $this->faker->paragraph,
        ];
    }
}