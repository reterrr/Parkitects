<?php

namespace App;

use App\Models\Reservation;
use Illuminate\View\View;

class ReservationMail implements Mail
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private Reservation $reservation
    ) {
    }

    public function make(): View
    {
        return view('reservation-confirm', [
            'parking_id' => $this->reservation->parkingPlace->parking_id,
            'parking_place' => $this->reservation->parkingPlace->id,
            'start_time' => $this->reservation->start_time,
            'end_time' => $this->reservation->end_time,
        ]);
    }
}
