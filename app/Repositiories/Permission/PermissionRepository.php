<?php

namespace App\Repositiories\Permission;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function whereIn(array $params, string $column = 'id'): Builder
    {
        return Permission::query()->whereIn($column, $params);
    }
}
