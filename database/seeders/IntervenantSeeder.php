<?php

namespace Database\Seeders;

use App\Models\Intervenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntervenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Intervenant::factory()->times(10)->create();
    }
}
