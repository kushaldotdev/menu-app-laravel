<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\TokenResponse;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    use TokenResponse;

    public function redirectToProvider($provider)
    {
        $validProviders = ['google', 'facebook', 'twitter', 'github'];
        if (!in_array($provider, $validProviders)) {
            return response()->json(['error' => 'Invalid provider'], 400);
        }
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
            $user = $this->findOrCreateUser($provider, $socialUser);

            $token = $this->respondWithToken(auth()->guard('api')->login($user));

            $accessToken = $token->original['access_token'];
            return view('auth.callback', ['origin' => env('FRONTEND_URL'), 'provider' => $provider, 'accessToken' => $accessToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => "Authentication failed with provider $provider: " . $e->getMessage()], 401);
        }
    }

    private function findOrCreateUser($provider, $socialUser)
    {
        $user = User::where("login_$provider", $socialUser->getId())
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if (!$user) {
            return User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'avatar' => $socialUser->getAvatar(),
                'password' => Hash::make(\Illuminate\Support\Str::random(8)), // Random password
                "login_$provider" => $socialUser->getId(),
                'email_verified_at' => now(),
            ]);
        }

        $userData = [];
        if (!$user->avatar) {
            $userData = ['avatar' => $socialUser->getAvatar()];
        }

        $user->update(["login_$provider" => $socialUser->getId(), ...$userData]);
        return $user;
    }
}
