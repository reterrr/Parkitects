<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Repositiories\Permission\PermissionRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PermissionService
{
    public function __construct(
        private PermissionRepositoryInterface $permissionsRepository
    ) {
    }

    public function attachPermissions(User $toUser, array $permissions)
    {
        $existingPermissions = $toUser->permissions()->whereIn('slug', $permissions)->get(['name']);

        $toUser->roles()->each(function (Role $role) use ($permissions, &$existingPermissions) {
            $existingPermissions = $existingPermissions->concat($role->permissions()->whereIn('slug', $permissions)->get(['name'])->toArray());
        });

        if ($existingPermissions->isNotEmpty())
            throw new HttpException(409, 'User already has these permissions: ' . $existingPermissions->implode('name', ', '));

        $toUser->roles()->attach($permissions);
    }

    public function dettachPermissions(User $toUser, array $permissions)
    {
        $permissions = $toUser->permissions()->whereIn('slug', $permissions);

        if (!$permissions->exists())
            throw new HttpException(404, 'No such permission');

        $toUser->permissions()->detach($permissions->get());
    }
}
