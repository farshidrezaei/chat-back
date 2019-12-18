<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\User;

class RegisterController extends Controller
{

    public function register( RegisterRequest $request )
    {

        $user = User::create( [
            'username' => $request->email,
            'email' => $request->email,
            'password' => $request->password,
        ] );

        return response( [
            'result' => 'success',
            'message' => 'ثبت نام با موفقیت انجام شد.',
            'data' => null
        ] );
    }
}
