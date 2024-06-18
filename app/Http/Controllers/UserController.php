<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\FindUserRequest;
use App\Http\Requests\GetUsersRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(UserService $service, GetUsersRequest $request)
    {
        return $service->list()->get();
    }

    public function update(UserService $service, UpdateUserRequest $request)
    {
        $service->update($request->validated(), $request->user);
    }

    public function delete(UserService $service, DeleteUserRequest $request)
    {
        $service->delete($request->user);
    }

    public function find(FindUserRequest $request)
    {
        return $request->user;
    }

    public function findMe(Request $request)
    {
        return $request->user();
    }
}
