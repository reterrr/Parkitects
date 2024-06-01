<?php

namespace App\Services;

use App\Exceptions\SuperAdminDelete;
use App\Models\User;
use App\Repositiories\User\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function list(): Collection
    {
        return $this->userRepository->list();
    }

    public function update(array $data, User $user): void
    {
        $user->update($data);
    }

    public function delete(User $user): void
    {
        if ($user->hasRole('super-admin'))
            throw new SuperAdminDelete();

        $user->delete();
    }
}
