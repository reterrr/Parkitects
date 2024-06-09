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

    public function attachRoles(User $fromUser, User $toUser, array $roles)
    {
        if ($toUser->hasRole($roles)) return;

        $roles = $this->roleRepository->rolesBySlug($roles);

        foreach ($roles as $role) {
            if ($fromUser->mainPriority() > $role->slug->rolePriority())
                throw new HttpException(409, 'Forbidden to attach this role: ' . $role);
        }

        $toUser->roles()->attach($roles);
    }
}
