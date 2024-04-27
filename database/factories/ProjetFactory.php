<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projet>
 */
class ProjetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateDebut = $this->faker->date;
        $dateFin = $this->faker->dateTimeBetween($dateDebut, '+1 months')->format('Y-m-d');
        return [
            'libelle' => $this->faker->sentence,
            'lieu' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'date_debut' => $dateDebut,
            'date_fin_prevue' => $dateFin,
            'fichier' => $this->faker->word,
            'statut' => $this->faker->randomElement(['en attente', 'en cours', 'terminé', 'arrêté']),

            'id_user' => function () {
                return User::inRandomOrder()->first()->id;
            },

            'id_gestionnaire' => function () {
         return User::where('id_profil', 2)->inRandomOrder()->first()->id;
         },

            'id_client' => function () {
                return Client::inRandomOrder()->first()->id;
            },
        ];
    }
}