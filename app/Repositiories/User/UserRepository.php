<?php

namespace App\Repositiories\User;

use App\Exceptions\SuperAdminDelete;
use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function all(): Collection
    {
        return User::query()->get();
    }

    public function update(array $data, int $id)
    {
        User::query()->where('id', $id)->update($data);
    }

    public function delete(int $id): void
    {
        $user = User::query()->where('id', $id)->first();

        if ($user->hasRole('super-admin'))
            throw new SuperAdminDelete();

        $user->delete();
    }

    public function find(int $id)
    {
        return User::query()->where('id', $id)->first();
    }

    public function userExists(int $id): bool
    {
        return User::query()->where('id', $id)->exists();
    }
}
