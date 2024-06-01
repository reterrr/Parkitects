<?php

namespace App\Repositiories;

interface RepositoryInterface
{
    public function create(array $data);

    public function list();

    public function find(int $id);

    public function delete(int $id);

    public function update(int $id, array $data);
}
