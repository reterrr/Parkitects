<?php

namespace App\Services;

use App\Repositiories\User\UserRepository;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function all(): Collection
    {
        return $this->userRepository->all();
    }

    public function update(array $data, int $id): void
    {
        if (!$this->userRepository->userExists($id))
            throw new HttpException(409, 'No such user');

        $this->userRepository->update($data, $id);
    }

    public function delete(int $id): void
    {
        if (!$this->userRepository->userExists($id))
            throw new HttpException(409, 'No such user');

        $this->userRepository->delete($id);
    }

    public function find(int $id)
    {
        return $this->userRepository->find($id);
    }
}
