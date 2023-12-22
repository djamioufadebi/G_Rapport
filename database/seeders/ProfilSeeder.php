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
        Profil::factory()->gestionnaire()->create();
        Profil::factory()->chefChantier()->create();
        Profil::factory()->magasinier()->create();
        Profil::factory()->utilisateurSimple()->create();

    }

}
