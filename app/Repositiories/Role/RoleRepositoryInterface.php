<?php

namespace App\Repositiories\Role;

use App\Repositiories\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface
{
    public function recordExists(int $id): bool;
    public function rolesBySlug(array $slug);
}
