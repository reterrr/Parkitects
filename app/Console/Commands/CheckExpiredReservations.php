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

    public function __invoke(): void
    {
        Reservation::query()
            ->where('status', ReservationStatus::CURRENT->value)
            ->where('end_time', '<=', Carbon::now()->timezone('Europe/Warsaw')->format('Y-m-d H:i'))
            ->update(['status' => ReservationStatus::EXPIRED->value]);
    }
}
