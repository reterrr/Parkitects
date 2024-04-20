<?php

namespace App\Services;

use App\UserRepository;
use Illuminate\Support\Collection;

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
            throw new \Exception('No such user', 409);

        $this->userRepository->update($data, $id);
    }

    public function delete(int $id): void
    {
        if (!$this->userRepository->userExists($id))
            throw new \Exception('No such user', 409);

        $this->userRepository->delete($id);
    }

    public function find(int $id)
    {
        return $this->userRepository->find($id);
    }
}
