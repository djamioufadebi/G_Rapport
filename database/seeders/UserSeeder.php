<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  /*  public function run(): void
    {
        User::factory()->times(10)->create();
    } */

    public function run()
    {
        // Créer le Président
        User::factory()->create([
            'nom' => 'HUGO',
            'prenom' => 'Jean',
            'email' => 'admin@gmail.com',
            'id_profil' => 1, 
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'nom' => 'KOKOU',
            'prenom' => 'Christian',
            'email' => 'manager@gmail.com',
            'id_profil' => 2, 
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'nom' => 'BODJO',
            'prenom' => 'Hurgobert',
            'email' => 'user@gmail.com',
            'id_profil' => 3, 
            'password' => Hash::make('password'),
        ]);
    }

}
