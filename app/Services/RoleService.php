<?php

namespace App\Services;

use App\Models\Role;
use App\Repositiories\Role\RoleRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RoleService
{
    public function __construct(
        private RoleRepositoryInterface $roleRepository
    ) {
    }

    public function create(array $data)
    {
        if (Role::query()->where('slug', $data['slug'])->exists())
            throw new HttpException(409, 'Already exists');

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
            throw new HttpException(409, 'Doesn\'t exist');

        $this->roleRepository->delete($id);
    }
}
