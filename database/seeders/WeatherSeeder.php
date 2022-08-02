<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Weather;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Weather::insert([
            'id' => 1,
            'name' => '大阪',
            'latitude' => 34.68631997,
            'longitude' => 135.5200224,
            ]);
    }
}
