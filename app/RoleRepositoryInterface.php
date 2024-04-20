<?php

namespace App;

interface RoleRepositoryInterface extends RepositoryInterface
{
    public function recordExists(int $id): bool;
}
