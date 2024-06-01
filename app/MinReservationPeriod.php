<?php

namespace App;

use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MinReservationPeriod implements ValidReservationRule
{
    public function validate(array $data): void
    {
        $startTime = Carbon::parse($data['start_time']);
        $endTime = Carbon::parse($data['end_time']);

        if ($startTime->diffInMinutes($endTime) < config('reservation.min_reservation_time'))
            throw new HttpException(409, 'Reservation can\'t be done for less than 30 minutes');
    }
}
