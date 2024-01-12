<?php

namespace Database\Seeders;

use App\Models\Besoin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BesoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Besoin::factory()->times(10)->create();
    }
}