<?php

namespace App\Repositiories\Reservation;

use App\Repositiories\RepositoryInterface;

interface ReservationRepositoryInterface extends RepositoryInterface
{
    public function isPossible(string $startTime, string $endTime): bool;
}
