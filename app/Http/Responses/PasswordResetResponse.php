<?php

namespace App\Http\Responses;

use App\Providers\RouteServiceProvider;
use Laravel\Fortify\Contracts\PasswordResetResponse as FortifyPasswordResetResponse;

class PasswordResetResponse implements FortifyPasswordResetResponse
{
    public function toResponse($request)
    {
        dd($request);
    }
}
