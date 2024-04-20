<?php

namespace App\Services;

use App\Models\Role;
use App\RoleRepositoryInterface;

class RoleService
{
    public function __construct(
        protected RoleRepositoryInterface $roleRepository
    ) {
    }

    public function create(array $data)
    {
        if (Role::query()->where('slug', $data['slug'])->exists())
            throw new \Exception('Already exists', 409);

        $this->roleRepository->create($data);
    }

    public function find(int $id)
    {
        return $this->roleRepository->find($id);
    }

    public function all()
    {
        return $this->roleRepository->all();
    }

    public function delete(int $id)
    {
        if (!$this->roleRepository->recordExists($id))
            throw new \Exception('Doesn\'t exist', 409);

        $this->roleRepository->delete($id);
    }
}
