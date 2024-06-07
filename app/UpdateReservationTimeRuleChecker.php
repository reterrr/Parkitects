<?php

namespace App;


class UpdateReservationTimeRuleChecker extends ReservationTimeRuleChecker
{
    public function forData(array $data): static
    {
        if (!isset($data['start_time']) || !isset($data['end_time']))
            return $this;

        return parent::forData($data);
    }
}
