<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

class ParkingPlace extends Model
{
    use HasFactory;

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class);
    }

    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }

    public function isOccupied(string $time): bool
    {
        $time = Carbon::createFromFormat('YYY-m-d H:i', $time);

        return $this->reservations()
            ->where('start_time', '<=', $time)
            ->where('end_time', '>=', $time)
            ->exists();
    }
}
