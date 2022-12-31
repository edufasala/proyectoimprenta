<?php

namespace App\Http\Responses;

use App\Providers\RouteServiceProvider;
use Laravel\Fortify\Contracts\RegisterResponse as FortifyRegisterResponse;

class RegisterResponse implements FortifyRegisterResponse
{
    public function toResponse($request)
    {
        return redirect(RouteServiceProvider::HOME);
    }
}
