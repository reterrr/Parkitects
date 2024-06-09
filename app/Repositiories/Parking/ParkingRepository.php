<?php

namespace App\Repositiories\Parking;

use App\Models\Parking;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ParkingRepository implements ParkingRepositoryInterface
{
    public function list()
    {
        return QueryBuilder::for(Parking::class)->allowedFilters([
            AllowedFilter::callback('search', function (Builder $query, string $value): Builder {
                return $query->where('name', 'like', "%%$value%%");
            })
        ]);
    }

    public function find(int $id)
    {
        return Parking::query()->where('id', $id)->first();
    }
}
