<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckFreePlacesRequest;
use App\Http\Resources\ParkingResource;
use App\Services\ParkingService;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    public function list(ParkingService $service)
    {
        return $service->list();
    }

    public function find(Request $request)
    {
        return ParkingResource::make($request->parking);
    }

    public function checkFreePlaces(ParkingService $service, CheckFreePlacesRequest $request)
    {
        $data = $request->validated();
        $data['parking_id'] = $request->parking->id;

        return $service->checkFreePlaces($data);
    }
}
