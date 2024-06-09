<?php

namespace App\Http\Resources;

use App\Models\ParkingPlace;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkingPlaceResource extends JsonResource
{
    /**
     * @var ParkingPlace
     */
    public $resource;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
        ];
    }
}
