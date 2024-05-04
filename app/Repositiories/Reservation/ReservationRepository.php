<?php

namespace App\Repositiories\Reservation;

use App\Models\Reservation;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function all()
    {
        //
    }

    public function find(int $id)
    {
        return Reservation::query()->where('id', $id)->first();
    }

    public function delete(int $id): void
    {
        Reservation::query()->where('id', $id)->delete();
    }

    public function create(array $data): void
    {
        Reservation::query()->create([
            'user_id' => $data['user_id'],
            'parking_place_id' => $data['parking_place_id'],
            'status' => $data['status'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time']
        ]);
    }

    public function update(int $id, array $data): void
    {
        Reservation::query()->where('id', $id)->update($data);
    }

    public function isPossible(string $startTime, string $endTime): bool
    {
        return !Reservation::query()->where('start_time', '>', $endTime)
            ->orWhere('end_time', '<', $startTime)->exists();
    }
}
