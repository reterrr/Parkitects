<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoogleRequest;
use App\Http\Resources\TokenResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse as Redirect;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleController extends Controller
{
    public function login(GoogleRequest $request): TokenResource
    {
        $response = Socialite::driver('google')->getAccessTokenResponse($request->token);

        $user = Socialite::driver('google')->userFromToken($response['access_token']);

        $newUser = User::query()->firstOrCreate(
            ['email' => $user['email']
            ],[
            'name' => $user['name'],
        ]);

        return TokenResource::make($newUser->createToken('api')->plainTextToken);
    }

    public function token(Request $request): never
    {
       dd($request->get('code'));
    }

    public function page(): Redirect|RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }
}
