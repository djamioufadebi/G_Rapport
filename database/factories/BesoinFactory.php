<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use App\Models\Activite;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Besoin>
 */
class BesoinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $faker = FakerFactory::create('fr_FR');
        $faker->addProvider(new FakerGenerator());
        return [
            'libelle' => $this->faker->sentence,
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'contenu' => $this->faker->paragraph,
            'commentaires' => $this->faker->text,
            'fichier' => $this->faker->word,
            'statut' => $this->faker->randomElement(['en attente', 'Validé', 'rejeté']),
            'id_activite' => function () {
                return Activite::inRandomOrder()->first()->id;
            },
        ];
    }
}