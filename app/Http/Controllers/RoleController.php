<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteRoleRequest;
use App\Http\Requests\FindRoleRequest;
use App\Models\Role;
use App\Services\RoleService;

class RoleController extends Controller
{
    public function list(RoleService $service)
    {
        return $service->list();
    }

//    public function create(RoleService $service, CreateRoleRequest $request): void
//    {
//        $service->create($request->validated());
//    }

    public function find(FindRoleRequest $request): Role
    {
        return $request->role;
    }

    public function delete(DeleteRoleRequest $request): void
    {
        $request->role->delete();
    }
}
