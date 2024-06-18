<?php

namespace App\Repositiories\Reservation;

use App\Models\Reservation;
use App\Models\User;
use App\ReservationStatus;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function list(): QueryBuilder
    {
        return QueryBuilder::for(Reservation::class)
            ->allowedFilters([
                AllowedFilter::callback('reservation_time', function (Builder $query, array $value): Builder {
                    $startTime = $value['start_time'] ?? null;
                    $endTime = $value['end_time'] ?? null;

                    return $query->when(!is_null($startTime), function (Builder $query) use ($startTime): Builder {
                        return $query->where('end_time', '>', $startTime);
                    })
                        ->when(!is_null($endTime), function (Builder $query) use ($endTime): Builder {
                            return $query->where('start_time', '>', $endTime);
                        });
                }),
                AllowedFilter::callback('parking_place', function (Builder $query, array|string $value): Builder {
                    return $query->whereIn('parking_place_id', (array)$value);
                }),
                AllowedFilter::callback('status', function (Builder $query, array|string $value): Builder {
                    return $query->whereIn('status', array_map([ReservationStatus::class, 'from'], (array)$value));
                })
            ]);
    }

    public function find(int $id)
    {
        return Reservation::query()->where('id', $id)->first();
    }

    public function delete(int $id): void
    {
        Reservation::query()->where('id', $id)->delete();
    }

    public function create(array $data): Reservation
    {
        $reservation = Reservation::query()->create([
            'user_id' => $data['user_id'],
            'parking_place_id' => $data['parking_place_id'],
            'status' => ReservationStatus::CURRENT->value,
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time']
        ]);

        return $reservation;
    }

    public function update(int $id, array $data): void
    {
        Reservation::query()->where('id', $id)->update($data);
    }

    public function isCreateTimePossible(int $parkingPlaceId, string $startTime, string $endTime): bool
    {
        return !Reservation::query()
            ->where('parking_place_id', $parkingPlaceId)
            ->where(function (Builder $query) use ($startTime, $endTime) {
                return $query->where(function (Builder $query) use ($endTime): Builder {
                    return $query->where('start_time', '<=', $endTime)
                        ->where('end_time', '>=', $endTime);
                })->orWhere(function (Builder $query) use ($startTime): Builder {
                    return $query->where('start_time', '<=', $startTime)
                        ->where('end_time', '>=', $startTime);
                })->orWhere(function (Builder $query) use ($startTime, $endTime): Builder {
                    return $query->where('start_time', '>=', $startTime)
                        ->where('end_time', '<=', $endTime);
                });
            })->exists();
    }

    public function cancel(int $id): void
    {
        Reservation::query()->where('id', $id)->update([
            'status' => ReservationStatus::CANCELED->value
        ]);

        $this->delete($id);
    }

    public function listForUser(User $user): QueryBuilder
    {
        return $this->list()->where('user_id', $user->id);
    }

    public function listForAdmin(): QueryBuilder
    {
        return $this->list()
            ->allowedFilters([
                AllowedFilter::callback('user_id', function (Builder $query, array $value): Builder {
                    return $query->whereIn('user_id', $value);
                }),
                AllowedFilter::callback('search', function (Builder $query, string $value): Builder {
                    return $query->join('users', 'id', '=', 'user_id')
                        ->where('name', 'like', "%$value%")
                        ->orWhere('email', 'like', "%$value%");
                })
            ]);
    }

    public function isUpdateTimePossible(int $reservationId, string $startTime, string $endTime): bool
    {
        $parkingPlaceId = Reservation::query()->find($reservationId)->parking_place_id;

        return !Reservation::query()
            ->where('parking_place_id', $parkingPlaceId)
            ->where('id', '<>', $reservationId)
            ->where(function (Builder $query) use ($endTime): Builder {
                return $query->where('start_time', '<=', $endTime)
                    ->where('end_time', '>=', $endTime);
            })->orWhere(function (Builder $query) use ($startTime): Builder {
                return $query->where('start_time', '<=', $startTime)
                    ->where('end_time', '>=', $startTime);
            })->orWhere(function (Builder $query) use ($startTime, $endTime): Builder {
                return $query->where('start_time', '>=', $startTime)
                    ->where('end_time', '<=', $endTime);
            })->exists();
    }
}
