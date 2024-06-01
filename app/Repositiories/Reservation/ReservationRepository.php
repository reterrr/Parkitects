<?php

namespace App\Repositiories\Reservation;

use App\Models\Reservation;
use App\Models\User;
use App\ReservationStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function list(): QueryBuilder
    {
        //TODO start_time and end_time can be alone
        return QueryBuilder::for(Reservation::class)
            ->allowedFilters([
                AllowedFilter::callback('reservation_time', function (Builder $query, array $value): Builder {
                    return $query->where(function (Builder $query) use ($value) {
                        return $query->whereDate('start_time', '>=', Carbon::createFromFormat('Y-m-d H:i', $value['start_time']))
                            ->whereDate('end_time', '<=', Carbon::createFromFormat('Y-m-d H:i', $value['end_time']));
                    })->orWhere(function (Builder $query) use ($value) {
                        return $query->whereDate('start_time', '<=', Carbon::createFromFormat('Y-m-d H:i', $value['start_time']))
                            ->whereDate('end_time', '>=', Carbon::createFromFormat('Y-m-d H:i', $value['end_time']));
                    });
                }),
                AllowedFilter::callback('parking_place', function (Builder $query, array $value): Builder {
                    return $query->whereIn('parking_place_id', $value);
                }),
                AllowedFilter::callback('status', function (Builder $query, array $value): Builder {
                    return $query->whereIn('status', array_map([ReservationStatus::class, 'from'], $value));
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

    public function create(array $data): void
    {
        Reservation::query()->create([
            'user_id' => $data['user_id'],
            'parking_place_id' => $data['parking_place_id'],
            'status' => ReservationStatus::CURRENT->value,
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time']
        ]);
    }

    public function update(int $id, array $data): void
    {
        Reservation::query()->where('id', $id)->update($data);
    }

    public function isCreateTimePossible(string $startTime, string $endTime): bool
    {
        return !Reservation::query()->where(function (Builder $query) use ($endTime): Builder {
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

    public function cancel(int $id): void
    {
        Reservation::query()->where('id', $id)->update([
            'status' => ReservationStatus::CANCELED->value
        ]);

        $this->delete($id);
    }

    public function listForUser(User $user)
    {
        return $this->list()->where('user_id', $user->id);
    }

    public function listForAdmin()
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

    public function isUpdateTimePossible(int $id, string $startTime, string $endTime): bool
    {
        return !Reservation::query()->where('id','<>', $id)
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
