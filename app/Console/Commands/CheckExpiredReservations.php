<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use App\ReservationStatus;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expired-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check whether there are no expired reservations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Reservation::query()
            ->where('status', ReservationStatus::CURRENT->value)
            ->where('end_time', '<=', Carbon::now())
            ->update(['status' => ReservationStatus::EXPIRED->value]);
    }
}
