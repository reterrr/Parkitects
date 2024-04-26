<?php

namespace App;

use App\Models\Role;

trait HasPriority
{
    public function mainPriority(): int
    {
        return $this->roles->min(function (Role $role) {
            return $role->priority();
        });
    }
}
