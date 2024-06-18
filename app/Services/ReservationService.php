<?php

namespace App\Services;

use App\CreateReservationTimeRuleChecker;
use App\MinReservationPeriod;
use App\Models\Reservation;
use App\Models\User;
use App\NotConflictingReservationRule;
use App\NotConflictingUpdateReservationRule;
use App\Repositiories\Reservation\ReservationRepositoryInterface;
use App\ReservationStatus;
use App\UpdateReservationTimeRuleChecker;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReservationService
{
    public function __construct(
        private ReservationRepositoryInterface $repository
    ) {
    }

    public function list(User $user)
    {
        if ($user->hasPermissionTo('reservations.get'))
            return $this->repository->listForAdmin()->get();

        return $this->repository->listForUser($user)->get();
    }

    public function cancel(Reservation $reservation): void
    {
        if ($reservation->status != ReservationStatus::CURRENT)
            throw new HttpException(409, 'Reservation is already cancelled or expired');

        $reservation->update(['status' => ReservationStatus::CANCELED->value]);
        $reservation->delete();
    }

    public function create(User $user, array $data): void
    {
        CreateReservationTimeRuleChecker::make()
            ->forRules($this->makeReservationRules())
            ->forData($data)
            ->validate();

        $data['user_id'] = $user->id;

        $reservation = $this->repository->create($data);

        //TODO: maybe add some event for sending invoice to user email

        event();
    }

    private function makeReservationRules(): array
    {
        return [
            new MinReservationPeriod,
            new NotConflictingReservationRule
        ];
    }

    private function updateReservationRules(): array
    {
        return [
            new MinReservationPeriod,
            new NotConflictingUpdateReservationRule
        ];
    }

    public function update(Reservation $reservation, array $data): void
    {
        UpdateReservationTimeRuleChecker::make()
            ->forRules($this->updateReservationRules())
            ->forData($data)
            ->validate();

        $reservation->update($data);
    }
}
