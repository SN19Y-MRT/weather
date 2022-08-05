<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Weather;

class WeatherSeeder extends Seeder
{
    const cities = [
        [
            'id' => 1,
            'name' => '大阪',
            'latitude' => 34.68631997,
            'longitude' => 135.5200224,
        ],
        [
            'id' => 2,
            'name' => '北海道',
            'latitude' => 34.68631997,
            'longitude' => 135.5200224,
        ]
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach(self::cities as $city)
        {
            Weather::insert([
            'id' => $city['id'],
            'name' => $city['name'],
            'latitude' => $city['latitude'],
            'longitude' => $city['longitude'],
            ]);
        }
    }
}
