<?php

namespace App\Providers;

use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use App\Exceptions\UserDisabledException;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Fortify::registerView(function (){
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function (){
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request){
            return view('auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->input( 'email'))->first();

            if (is_null($user)) {
                return null;
            }

            if (false === Hash::check($request->input('password'), $user->password)) {
                return null;
            }

            throw_if($user->isDisabled(), UserDisabledException::class, $request);

            if ($user->isDisabled()) {
                throw validationException::withMessages([
                    Fortify::username() => [trans('auth.blocked')],
                ]);
            }

            return $user;
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
