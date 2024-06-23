<?php

namespace App\Http\Resources;

use App\Models\Parking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkingResource extends JsonResource
{
    /**
     * @var Parking
     */
    public $resource;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = false;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'address' => $this->resource->address,
            'country' => $this->resource->country,
            'longitude' => $this->resource->longitude,
            'latitude' => $this->resource->latitude,
            'parking_places' => ParkingPlaceResource::collection($this->resource->parkingPlaces()->get())
        ];
    }
}
