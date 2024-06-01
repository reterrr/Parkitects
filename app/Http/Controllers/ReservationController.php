<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancelReservationRequest;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\ListReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Services\ReservationService;

class ReservationController extends Controller
{
    public function list(ReservationService $service, ListReservationRequest $request)
    {
        return $service->list($request->user());
    }

    public function cancel(ReservationService $service, CancelReservationRequest $request): void
    {
        $service->cancel($request->reservation);
    }

    public function create(ReservationService $service, CreateReservationRequest $request): void
    {
        $service->create($request->user(), $request->validated());
    }

    public function update(ReservationService $service, UpdateReservationRequest $request): void
    {
       $service->update($request->reservation, $request->validated());
    }
}
