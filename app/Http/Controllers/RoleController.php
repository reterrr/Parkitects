<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachUserRoleRequest;
use App\Http\Requests\FindRoleRequest;
use App\Models\Role;
use App\Services\RoleService;

class RoleController extends Controller
{
    public function list(RoleService $service)
    {
        return $service->list();
    }

    public function find(FindRoleRequest $request): Role
    {
        return $request->role;
    }

    public function attachRoles(RoleService $service, AttachUserRoleRequest $request)
    {
        $service->attachRoles($request->user(), $request->user, $request->validated());
    }
}
