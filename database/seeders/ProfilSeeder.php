<?php

namespace Database\Seeders;

use App\Models\Profil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Profil::factory()->times(5)->create();
        Profil::factory()->administrateur()->create();
        Profil::factory()->manager()->create();
        Profil::factory()->Gestionnaire()->create();
        Profil::factory()->chefChantier()->create();
        Profil::factory()->utilisateurSimple()->create();
        // ... et ainsi de suite pour les autres profils
    }

}