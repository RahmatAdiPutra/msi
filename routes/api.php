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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    // 'middleware' => [],
    'namespace' => 'Api'
],function () {
    Route::group([
        'prefix' => 'setting'
    ],function () {
        Route::get('/data/{setting}', 'SettingController@data');
    });

    Route::group([
        'prefix' => 'user',
        'as' => 'user.'
    ],function () {
        Route::get('/data', 'UserController@data')->name('data');
        Route::post('/', 'UserController@create')->name('create');
        Route::get('/{user}', 'UserController@read')->name('read');
        Route::put('/{user}', 'UserController@update')->name('update');
        Route::delete('/{user}', 'UserController@delete')->name('delete');
    });
});
