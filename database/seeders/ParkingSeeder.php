<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Przykładowe dane parkingów
        $parkings = [
            ['name' => '55 West 46th Street - Valet Garage', 'address' => '55 West 46th Street, New York, NY 10036', 'country' => 'United States', 'latitude' => 40.757978, 'longitude' => -73.984250],
            ['name' => 'Raimundo Fernández Villaverde 57 bajo', 'address' => 'Raimundo Fernández Villaverde 57 bajo, 28003 Madrid', 'country' => 'Spain', 'latitude' => 40.446947, 'longitude' => -3.694556],
            ['name' => 'Royal Tulip (Warsaw)', 'address' => 'Grzybowska 49, Warsaw', 'country' => 'Poland', 'latitude' => 52.235047, 'longitude' => 20.988370],
            ['name' => 'Tiefgarage Friedrichstadt-Passagen (Q 206)', 'address' => 'Taubenstraße 14, Berlin', 'country' => 'Germany', 'latitude' => 52.514500, 'longitude' => 13.388600],
            ['name' => 'Barceló (Madrid)', 'address' => 'Barceló s/n, 28004 Madrid', 'country' => 'Spain', 'latitude' => 40.429498, 'longitude' => -3.699582],
            ['name' => 'Parking NFM Wrocław (Wrocław)', 'address' => 'Plac Wolności 1, 50-071 Wrocław', 'country' => 'Poland', 'latitude' => 51.109374, 'longitude' => 17.032930],
            ['name' => 'Parking Indigo - Bastille', 'address' => 'Paris', 'country' => 'France', 'latitude' => 48.852970, 'longitude' => 2.369860],
            ['name' => 'Q-Park (London)', 'address' => 'Queen\'s Way, Bayswater, London', 'country' => 'United Kingdom', 'latitude' => 51.512750, 'longitude' => -0.188870],
            ['name' => 'Parking Garage (Amsterdam)', 'address' => 'IJDock 33, 1013 MM Amsterdam', 'country' => 'Netherlands', 'latitude' => 52.385210, 'longitude' => 4.896420],
            ['name' => 'Interparking (Brussels)', 'address' => 'Rue de l\'Evêque 1, 1000 Brussels', 'country' => 'Belgium', 'latitude' => 50.846730, 'longitude' => 4.354360],
        ];

        // Dodanie pól created_at i updated_at
        $currentTimestamp = Carbon::now();

        foreach ($parkings as &$parking) {
            $parking['created_at'] = $currentTimestamp;
            $parking['updated_at'] = $currentTimestamp;
        }

        // Wypełnienie tabeli danymi
        DB::table('parkings')->insert($parkings);
    }
}
