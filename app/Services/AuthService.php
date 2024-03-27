<?php

namespace App\Services;

use App\Exceptions\LoginFailedException;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): Response
    {
        if (User::query()->where('email', $data['email'])->exists())
            return response('User already exits', 409);

        User::query()->create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password'])
        ]);

        return response('User successfully created!');
    }

    public function tokenOrFail(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated()))
            throw new LoginFailedException();

        return $request->user()->createToken('access_token')->plainTextToken;
    }

    public function logout(User $user): bool
    {
        return $user->currentAccessToken()->delete();
    }
}
