<?php

namespace App\Http\Controllers;

use App\Models\ParkingPlace;
use Illuminate\Http\Request;

class ParkingPlaceController extends Controller
{
    // Inne metody...

    /**
     * Get the parking for a given parking place
     *
     * @param int $parkingPlaceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getParkingByPlace($parkingPlaceId)
    {
        $parkingPlace = ParkingPlace::findOrFail($parkingPlaceId);
        $parking = $parkingPlace->parking;

        return response()->json($parking);
    }
}
