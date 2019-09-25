<?php

use Illuminate\Http\Request;
use GuzzleHttp\Client;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/callback', function () {

    $user = App\User::find(1);
    $http = new Client;
    $password = "password";

    $response = $http->post('http://authsample.test/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => 'H57PEfu7sJDV2ozCsbdihdRHQmfPBR5TS1MEjJLZ',
            'username' => $user->email,
            'password' => $password
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});