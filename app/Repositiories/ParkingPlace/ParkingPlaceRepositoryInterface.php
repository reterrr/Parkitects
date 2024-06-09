<?php

namespace App\Repositiories\ParkingPlace;


interface ParkingPlaceRepositoryInterface
{
    public function freePlaces(int $parkingId, string $startTime, string $endTime);
    public function find(int $id);
}
