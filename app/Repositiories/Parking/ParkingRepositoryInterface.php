<?php

namespace App\Repositiories\Parking;


interface ParkingRepositoryInterface
{
    public function list();
    public function find(int $id);
}
