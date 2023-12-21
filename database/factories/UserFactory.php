<?php

namespace Database\Factories;

use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

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
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            //'password' => static::$password ??= Hash::make('password'),
            'password' => Hash::make('12345678'),
            // pour definir un factory pour le champ étranger:
            //recupère un id_profil aléatoire depuis la table Profils
            'id_profil' => function () {
                return Profil::inRandomOrder()->first()->id;
            },
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}