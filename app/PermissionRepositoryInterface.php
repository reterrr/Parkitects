<?php

namespace App;



use Illuminate\Database\Eloquent\Builder;

interface PermissionRepositoryInterface
{
    public function whereIn(array $params, string $column = 'name'): Builder;
}
