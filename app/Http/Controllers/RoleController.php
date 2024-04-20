<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\DeleteRoleRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    public function all(RoleService $service)
    {
        return $service->all();
    }

    public function create(RoleService $service, CreateRoleRequest $request): void
    {
        $service->create($request->validated());
    }

    public function find(RoleService $service, Request $request)
    {
        return $service->find((int) $request->role);
    }

    public function delete(RoleService $service, DeleteRoleRequest $request)
    {
        $service->delete((int) $request->role);
    }
}
