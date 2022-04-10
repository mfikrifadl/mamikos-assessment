<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => 'recharge'
], function ($router) {
    Route::group([
        'middleware' => 'api',
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
        Route::post('register/owner', 'RegisterController@registerOwner');
        Route::post('register/user/premium', 'RegisterController@registerUserPremium');
        Route::post('register/user/regular', 'RegisterController@registerUserRegular');
    });

    Route::group([
        'middleware' => 'api',
        'prefix' => 'kost'
    ], function ($router) {
        Route::post('add', 'KostController@store');
        Route::post('ask-avail', 'AvailableController@askAvail');
        Route::put('edit/{id}', 'KostController@edit');
        Route::delete('delete/{id}', 'KostController@deleteKost');
        Route::get('/mylist', 'KostController@myKostlist');
        Route::get('/{id}', 'KostController@getDetailKost');
        Route::get('/', 'KostController@getAllKost');
    });

    Route::group([
        'middleware' => 'api',
        'prefix' => 'ask'
    ], function ($router) {
        Route::get('/list', 'AvailableController@getMyList');
        Route::get('/owner-list', 'KostController@getAskList');
        Route::post('/answer', 'KostController@answerAsk');
    });
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
