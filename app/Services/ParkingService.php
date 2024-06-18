<?php

namespace App\Services;

use App\Repositiories\Parking\ParkingRepositoryInterface;
use App\Repositiories\ParkingPlace\ParkingPlaceRepositoryInterface;

class ParkingService
{
    public function __construct(
        private ParkingRepositoryInterface      $parkingRepository,
        private ParkingPlaceRepositoryInterface $parkingPlaceRepository
    ) {
    }

    public function list()
    {
        return $this->parkingRepository->list()->get();
    }

    public function checkFreePlaces(array $data)
    {
        return $this->parkingPlaceRepository->freePlaces($data['parking_id'], $data['start_time'], $data['end_time']);
    }
}
