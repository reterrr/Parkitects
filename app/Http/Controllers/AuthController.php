<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\TokenResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(LoginRequest $request, AuthService $service): TokenResource
    {
        return TokenResource::make($service->tokenOrFail($request));
    }

    public function register(RegisterRequest $request, AuthService $service): void
    {
        $service->register($request->validated());
    }

    public function logout(AuthService $service, Request $request): void
    {
        $service->logout($request->user());
    }

    public function forgotPassword(AuthService $service, Request $request): JsonResponse
    {
        return $service->forgotPassword($request);
    }

    public function resetPassword(AuthService $service, Request $request): JsonResponse
    {
        return $service->resetPassword($request);
    }
}
