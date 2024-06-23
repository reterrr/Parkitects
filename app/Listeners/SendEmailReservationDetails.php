<?php

namespace App\Listeners;

use App\Events\ReservationCreated;
use App\Mail\ReservationDetailsMail;
use Illuminate\Support\Facades\Mail;


class SendEmailReservationDetails
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReservationCreated $event): void
    {
        Mail::send(new ReservationDetailsMail($event->reservation));
    }
}
