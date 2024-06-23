<?php

namespace Database\Seeders;

use App\Models\Parking;
use App\Models\ParkingPlace;
use Illuminate\Database\Seeder;

class ParkingPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Parking::all()->each(function (Parking $parking) {
            $numberOfPlaces = rand(30, 50); // Losowa liczba od 30 do 50
            for ($i = 0; $i < $numberOfPlaces; $i++) {
                ParkingPlace::query()->create([
                    'parking_id' => $parking->id,
                    'pillar' => rand(1, 4), // Dodane pole pillar z losową wartością
                ]);
            }
        });
    }
}
