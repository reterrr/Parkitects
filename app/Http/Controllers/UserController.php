<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all(UserService $service)
    {
        return $service->all();
    }

    public function update(UserService $service, UpdateUserRequest $request)
    {
        $service->update($request->all(), $request->user);
    }

    public function delete(UserService $service, DeleteUserRequest $request)
    {
        $service->delete($request->user);
    }

    public function find(UserService $service, Request $request)
    {
        return $service->find($request->user);
    }
}
