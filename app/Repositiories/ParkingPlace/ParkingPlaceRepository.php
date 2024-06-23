<?php

namespace App\Repositiories\ParkingPlace;

use App\Models\ParkingPlace;
use Illuminate\Support\Facades\DB;

class ParkingPlaceRepository implements ParkingPlaceRepositoryInterface
{
    public function find(int $id)
    {
        ParkingPlace::query()
        ->select('id', 'pillar')
        ->where('id', $id)
        ->first();
    }

    public function freePlaces(int $parkingId, string $startTime, string $endTime)
    {
        return  DB::table('parking_places')
            ->join('parkings', 'parking_places.parking_id', '=', 'parkings.id')
            ->leftJoin('reservations', function ($join) use ($startTime, $endTime) {
                $join->on('reservations.parking_place_id', '=', 'parking_places.id')
                    ->where(function ($query) use ($startTime, $endTime) {
                        $query->where('reservations.start_time', '<', $endTime)
                            ->where('reservations.end_time', '>', $startTime);
                    });
            })
            ->where('parkings.id', $parkingId)
            ->whereNull('reservations.id')
            ->select('parking_places.id', 'parking_places.pillar') 
            ->get();
    }
}
