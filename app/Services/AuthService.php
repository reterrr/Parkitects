<?php

namespace App\Services;

use App\Exceptions\LoginFailedException;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return response()->json([__($status)]);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            });

        return response()->json([__($status)]);
    }
}
