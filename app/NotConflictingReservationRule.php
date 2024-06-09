<?php

namespace App;

use App\Repositiories\Reservation\ReservationRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class NotConflictingReservationRule implements ValidReservationRule
{
    private ReservationRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = app(ReservationRepositoryInterface::class);
    }

    public function validate(array $data): void
    {
        if (!$this->repository->isCreateTimePossible($data['parking_place_id'], $data['start_time'], $data['end_time']))
            throw new HttpException(409, 'This time is conflicting with other reservation');
    }
}
