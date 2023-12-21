<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profil>
 */
class ProfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$profils = ['administrateur', 'manager', 'Gestionnaire', 'Chef chantier', 'Utilisateur simple'];

        return [
            // 'nom' => $this->faker->randomElement($profils),
        ];

    }

    // Définir des états pour les profils spécifiques
    public function configure()
    {
        return $this->state([
            'nom' => $this->faker->randomElement([
                'administrateur',
                'manager',
                'Gestionnaire',
                'Chef chantier',
                'Utilisateur simple'
            ]),
        ]);
    }

    // Associer des ID spécifiques aux noms de profil
    public function administrateur()
    {
        return $this->state([
            'nom' => 'administrateur',
            'id' => 1,
        ]);
    }

    public function manager()
    {
        return $this->state([
            'nom' => 'manager',
            'id' => 2,
        ]);
    }

    public function Gestionnaire()
    {
        return $this->state([
            'nom' => 'Gestionnaire',
            'id' => 3,
        ]);
    }

    public function chefChantier()
    {
        return $this->state([
            'nom' => 'Chef chantier',
            'id' => 4,
        ]);
    }

    public function utilisateurSimple()
    {
        return $this->state([
            'nom' => 'Utilisateur simple',
            'id' => 5,
        ]);
    }



}