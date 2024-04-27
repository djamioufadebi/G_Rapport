<?php

namespace Database\Factories;

use App\Models\Projet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activite>
 */
class ActiviteFactory extends Factory
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
            'nom' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'fichier' => $this->faker->word,
            'lieu' => $this->faker->address,
            'statut' => $this->faker->randomElement(['en attente', 'en cours', 'terminé', 'arrêté']),
            'taux_de_realisation' => $this->faker->randomFloat(2, 0, 100),
            // Génère un nombre décimal entre 0 et 100 avec 2 décimales
            'id_projet' => function () {
                return Projet::inRandomOrder()->first()->id;
            },
        ];
    }
}