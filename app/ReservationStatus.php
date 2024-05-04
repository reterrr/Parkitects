<?php

namespace App;

enum ReservationStatus: string
{
    case CURRENT = 'current';
    case EXPIRED = 'expired';
}
