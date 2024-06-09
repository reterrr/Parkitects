<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachUserPermissionsRequest;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    public function attachPermissions(PermissionService $service, AttachUserPermissionsRequest $request)
    {
        $service->attachPermissions($request->user(), $request->user, $request->validated());
    }
}
