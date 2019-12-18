<?php

use App\Http\Resources\User as UserResource;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group( [ 'middleware' => [ 'cors' ], 'namespace' => 'Api' ], function () {

    Route::group( [ 'prefix' => 'auth', 'namespace' => 'Auth' ], function () {

        Route::post( 'register', 'AuthController@register' );

        Route::post( 'login', 'AuthController@login' );

        Route::middleware( 'auth:api' )->post( 'logout', 'AuthController@logout' );

        Route::middleware( 'auth:api' )->post( 'user', 'AuthController@user' );

        Route::prefix( 'password' )->group( function () {

            Route::middleware( 'api:auth' )->post( 'confirm', 'LoginController@login' );
            Route::middleware( 'api' )->post( 'email', 'LoginController@logout' );
            Route::middleware( 'api' )->post( 'reset', 'LoginController@logout' );

        } );
    } );
} );


Route::get( 'test', function () {
    $user = new UserResource( User::findOrFail( 1 ) );
    return response()->json( $user );

} );