<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    public function login()
    {
        $credentials = request( [ 'email', 'password' ] );

        if ( ! $token = auth()->attempt( $credentials ) ) {
            return response()->json( [ 'error' => 'Unauthorized' ], 401 );
        }

        return $this->respondWithToken( $token );
    }

    public function logout()
    {
        auth()->logout();

        return response()->json( [ 'message' => 'Successfully logged out' ] );
    }
}
