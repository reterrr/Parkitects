<?php

namespace App\Repositiories\Reservation;

use App\Models\Reservation;
use App\Models\User;
use App\Repositiories\RepositoryInterface;

interface ReservationRepositoryInterface extends RepositoryInterface
{
    public function create(array $data): Reservation;

    public function isCreateTimePossible(int $parkingPlaceId, string $startTime, string $endTime);

    public function cancel(int $id): void;

    public function listForUser(User $user);

    public function listForAdmin();

    public function isUpdateTimePossible(int $reservationId, string $startTime, string $endTime): bool;
}
