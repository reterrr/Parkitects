<?php

namespace App\Repositiories\Reservation;

use App\Models\User;
use App\Repositiories\RepositoryInterface;

interface ReservationRepositoryInterface extends RepositoryInterface
{
    public function isCreateTimePossible(string $startTime, string $endTime): bool;
    public function cancel(int $id): void;
    public function listForUser(User $user);
    public function listForAdmin();
    public function isUpdateTimePossible(int $id, string $startTime, string $endTime): bool;
}
