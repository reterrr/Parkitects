<?php

namespace App\Repositiories\Role;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class RoleRepository implements RoleRepositoryInterface
{
    public function list(): Collection|array
    {
        return Role::query()->get();
    }

    public function find(int $id): Model|Collection|Builder|array|null
    {
        return Role::query()->find($id);
    }

    public function delete(int $id): void
    {
        if (Role::query()->find($id)->slug == 'super-admin')
            throw new Exception('Forbidden action', 403);

        Role::query()->where('id', $id)->delete();
    }

    public function create(array $data): void
    {
        $role = Role::query()->create([
            'name' => $data['name'],
            'slug' => $data['slug']
        ]);

        $role->givePermissions($data['permissions']);
    }

    public function update(int $id, array $data)
    {
        Role::query()->where('id', $id)->update($data);
    }

    public function recordExists(int $id): bool
    {
        return Role::query()->where('id', $id)->exists();
    }
}
