<?php

namespace App\Services;

use App\Models\User;
use App\Repositiories\Permission\PermissionRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PermissionService
{
    public function __construct(
        private PermissionRepositoryInterface $permissionsRepository
    ) {
    }

    public function attachPermissions(User $fromUser, User $toUser, array $permissions)
    {
        $existingPermissions = $toUser->permissions()->whereIn('slug', $permissions)->get();

        if ($existingPermissions->isNotEmpty())
            throw new HttpException(409, 'User already has these permissions: ' . $existingPermissions);

        $roles = $this->permissionsRepository;

        foreach ($roles as $role) {
            if ($fromUser->mainPriority() > $role->slug->rolePriority())
                throw new HttpException(409, 'Forbidden to attach this role: ' . $role);
        }

        $toUser->roles()->attach($roles);
    }
}
