<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        City::insert([
            ['name' => 'Managua'],
            ['name' => 'León'],
            ['name' => 'Granada'],
        ]);
    }
}

