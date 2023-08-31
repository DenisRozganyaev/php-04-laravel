<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Roles;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function viaGoogle()
    {
        $userData = Socialite::driver('google')->user();

        $user = User::where('google_id', '=', $userData->getId())
            ->orWhere('email', '=', $userData->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $userData->user['given_name'],
                'surname' => !empty($userData->user['family_name']) ? $userData->user['family_name'] : '_',
                'email' => $userData->getEmail(),
                'google_id' => $userData->getId(),
                'birthdate' => Date::create('-18 years')->format('Y-m-d'),
                'password' => Hash::make(Str::random(8)),
            ]);

            $user->assignRole(Roles::CUSTOMER->value);
        }

        if(!$user->google_id) {
            $user->update([
                'google_id' => $userData->getId()
            ]);
        }

        auth()->login($user, true);

        return auth()->user() ? redirect()->route('profile.edit') : redirect()->route('login');
    }
}
