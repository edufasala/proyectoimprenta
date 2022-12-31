<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Responses\LoginResponse as FortifyLoginResponse;
use Laravel\Fortify\Http\Responses\LogoutResponse as FortifyLogoutResponse;
use Laravel\Fortify\Http\Responses\RegisterResponse as FortifyRegisterResponse;
use Laravel\Fortify\Http\Responses\PasswordResetResponse as FortifyPasswordResetResponse;
use App\Http\Responses\LoginResponse;
use App\Http\Responses\LogoutResponse;
use App\Http\Responses\RegisterResponse;
use App\Http\Responses\PasswordResetResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance(FortifyLoginResponse::class, new LoginResponse);
        $this->app->instance(FortifyLogoutResponse::class, new LogoutResponse);
        $this->app->instance(FortifyRegisterResponse::class, new RegisterResponse);
        $this->app->instance(FortifyPasswordResetResponse::class, new PasswordResetResponse);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function(){
            return view('auth.login');
        });

        Fortify::registerView(function(){
            return view('auth.login');
        });

        Fortify::RequestPasswordResetLinkView(function(){
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function($request){
            return view('auth.reset-password', ['request' => $request]);
        });
    }
}
