<?php

namespace Database\Seeders;
use App\Models\Citizen;
use App\Models\City;
use Illuminate\Database\Seeder;

class CitizenSeeder extends Seeder
{
    public function run(): void
    {
        $cities = City::all();

        foreach ($cities as $city) {
            Citizen::factory()->count(10)->create([
                'city_id' => $city->id,
            ]);
        }
    }
}