<?php

namespace App\Repositiories\User;

interface UserRepositoryInterface
{
    public function all();

    public function update(array $data, int $id);

    public function delete(int $id);

    public function find(int $id);
}
