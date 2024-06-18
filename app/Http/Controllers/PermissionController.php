<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachUserPermissionsRequest;
use App\Http\Requests\DettachUserPermissionsRequest;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    public function attachPermissions(PermissionService $service, AttachUserPermissionsRequest $request)
    {
        $service->attachPermissions($request->user, $request->validated()['permissions']);
    }

    public function detachPermissions(PermissionService $service, DettachUserPermissionsRequest $request)
    {
        $service->dettachPermissions($request->user, $request->validated()['permissions']);
    }
}
