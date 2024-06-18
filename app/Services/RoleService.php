<?php

namespace App\Services;

use App\Models\User;
use App\Repositiories\Role\RoleRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RoleService
{
    public function __construct(
        private RoleRepositoryInterface $roleRepository
    ) {
    }

    public function find(int $id)
    {
        return $this->roleRepository->find($id);
    }

    public function list()
    {
        return $this->roleRepository->list();
    }

    public function attachRoles(User $fromUser, User $toUser, array $roles): void
    {
        $existingRoles = $toUser->roles()->whereIn('slug', $roles);
        if ($existingRoles->exists())
            throw new HttpException(409, 'User already has these roles: ' . $existingRoles->implode('name', ', '));

        $roles = $this->roleRepository->rolesBySlug($roles);

        foreach ($roles as $role) {
            if ($fromUser->mainPriority() > $role->slug->rolePriority())
                throw new HttpException(406, 'Forbidden to attach this role: ' . $role->name);
        }

        $toUser->roles()->attach($roles);
    }

    public function detachRoles(User $fromUser, User $toUser, array $roles): void
    {
        $existingRoles = $toUser->roles()->whereIn('slug', $roles);
        if (!$existingRoles->exists())
            throw new HttpException(409, 'User doesn\'t have those roles: ' . $existingRoles->implode('name', ', '));

        $roles = $this->roleRepository->rolesBySlug($roles);

        foreach ($roles as $role) {
            if ($fromUser->mainPriority() > $role->slug->rolePriority())
                throw new HttpException(406, 'Forbidden to detach this role: ' . $role->name);
        }

        $toUser->roles()->detach($roles);
    }
}
