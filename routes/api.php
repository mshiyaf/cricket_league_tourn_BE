
<?php

use Illuminate\Http\Request;

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

Route::prefix('v1')->group(function(){
    Route::post('login', 'Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('getUsers', 'Api\AuthController@getUsers');
        Route::get('teams', 'Api\ApiController@getTeams');
        Route::get('team/{name}', 'Api\ApiController@getTeam');
        Route::get('countries', 'CountriesController@show');
        // Route::get('getSlots/{staff_id}/{month}/{day}/{year}','Api\SlotsController@getSlots');
        // Route::post('bookSlot/{company_id}/{staff_id}/{month}/{day}/{year}','Api\AppointmentsController@bookSlot');
    });
});