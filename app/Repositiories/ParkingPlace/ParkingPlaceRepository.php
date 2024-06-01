<?php

namespace App\Repositiories\ParkingPlace;

use App\Models\ParkingPlace;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ParkingPlaceRepository implements ParkingPlaceRepositoryInterface
{
    public function list()
    {
        return QueryBuilder::for(ParkingPlace::class)
            ->allowedFilters([
                AllowedFilter::callback('')
            ]);
    }

    public function find(int $id)
    {
        ParkingPlace::query()->where('id', $id)->first();
    }

    public function delete(int $id): void
    {
        ParkingPlace::query()->where('id', $id)->delete();
    }

    public function create(array $data): void
    {
        ParkingPlace::create();
    }

    public function update(int $id, array $data): void
    {
        ParkingPlace::query()->where('id', $id)->update($data);
    }
}
