<?php

namespace App;

interface ValidReservationRule
{
    public function validate(array $data): void;
}
