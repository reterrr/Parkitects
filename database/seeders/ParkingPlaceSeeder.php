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
            for ($i = 0; $i < 50; $i++) {
                ParkingPlace::query()->create([
                    'parking_id' => $parking->id,
                ]);
            }
        });
    }
}
