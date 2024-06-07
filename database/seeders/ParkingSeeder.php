<?php

namespace Database\Seeders;

use App\Models\Parking;
use Illuminate\Database\Seeder;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            'Kiev', 'Warsaw', 'Berlin', 'Paris', 'Madrid', 'Rome', 'Amsterdam', 'Brussels', 'Vienna', 'Prague',
            'Budapest', 'Copenhagen', 'Dublin', 'Helsinki', 'Lisbon', 'London', 'Oslo', 'Stockholm', 'Athens', 'Bucharest',
            'Sofia', 'Belgrade', 'Ljubljana', 'Zagreb', 'Luxembourg City', 'Reykjavik', 'Tirana', 'Podgorica', 'Sarajevo', 'Skopje',
            'Tallinn', 'Riga', 'Vilnius', 'Minsk', 'Chisinau', 'San Marino', 'Monaco', 'Vaduz', 'Andorra la Vella', 'Valletta',
            'Bern', 'Nicosia', 'Yerevan', 'Tbilisi', 'Baku', 'Astana', 'Almaty', 'Ashgabat', 'Tashkent', 'Bishkek',
            'Dushanbe', 'Ulaanbaatar', 'Hanoi', 'Bangkok', 'Singapore', 'Kuala Lumpur', 'Jakarta', 'Manila', 'Taipei', 'Seoul',
            'Tokyo', 'Beijing', 'Shanghai', 'Hong Kong', 'Macau', 'New Delhi', 'Mumbai', 'Karachi', 'Dhaka', 'Colombo',
            'Kathmandu', 'Thimphu', 'Male', 'Islamabad', 'Abu Dhabi', 'Dubai', 'Riyadh', 'Doha', 'Kuwait City', 'Manama',
            'Muscat', 'Baghdad', 'Tehran', 'Damascus', 'Amman', 'Beirut', 'Jerusalem', 'Cairo', 'Tripoli', 'Tunis',
            'Algiers', 'Rabat', 'Casablanca', 'Accra', 'Lagos', 'Nairobi', 'Addis Ababa', 'Cape Town', 'Johannesburg'
        ];

        foreach ($locations as $location) {
            Parking::query()->create(['location' => $location]);
        }
    }
}
