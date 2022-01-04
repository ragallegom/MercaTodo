<?php

namespace App\Actions\Fortify;

use http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use App\Exceptions\UserDisabledException;

class AuthenticateUser
{
    /**
     * @throws ValidationException
     */
    public function authenticates(Request $request): ?User
    {
        $user = User::where('email', $request->input( 'email'))->first();

        if (is_null($user)) {
            return null;
        }

        if ($user->isDisabled()) {
            throw validationException::withMessages([
                Fortify::username() => [trans('auth.blocked')],
            ]);
        }

        if (false === Hash::check($request->input('password'), $user->password)) {
            return null;
        }

        return $user;
    }
}
