<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachUserRoleRequest;
use App\Http\Requests\DetachUserRoleRequest;
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

    public function attachRoles(RoleService $service, AttachUserRoleRequest $request): void
    {
        $service->attachRoles($request->user(), $request->user, $request->validated()['roles']);
    }

    public function detachRoles(RoleService $service, DetachUserRoleRequest $request): void
    {
        $service->detachRoles($request->user(), $request->user, $request->validated()['roles']);
    }
}
