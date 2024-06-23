<?php

namespace App\Models;

use App\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'parking_place_id',
        'status',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'status' => ReservationStatus::class
    ];

    public function parkingPlace(): BelongsTo
    {
        return $this->belongsTo(ParkingPlace::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
