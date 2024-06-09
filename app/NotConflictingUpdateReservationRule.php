<?php

namespace App;

use App\Repositiories\Reservation\ReservationRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class NotConflictingUpdateReservationRule implements ValidReservationRule
{
    private ReservationRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = app(ReservationRepositoryInterface::class);
    }

    public function validate(array $data): void
    {
        if (!$this->repository->isUpdateTimePossible($data['parking_id'], $data['parking_place_id'], $data['start_time'], $data['end_time']))
            throw new HttpException(409, 'Conflicting with other reservations');
    }
}
