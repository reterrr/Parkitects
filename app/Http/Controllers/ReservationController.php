<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListReservationRequest;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function list(ReservationService $service, ListReservationRequest $request)
    {
        return $service->list();
    }
}
