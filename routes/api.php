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
        Route::post('/relation', 'UserController@relation')->name('relation');
        Route::post('/', 'UserController@create')->name('create');
        Route::get('/{user}', 'UserController@read')->name('read');
        Route::put('/{user}', 'UserController@update')->name('update');
        Route::delete('/{user}', 'UserController@delete')->name('delete');
    });

    Route::group([
        'prefix' => 'role',
        'as' => 'role.'
    ],function () {
        Route::get('/data', 'RoleController@data')->name('data');
        Route::post('/relation', 'RoleController@relation')->name('relation');
        Route::post('/', 'RoleController@create')->name('create');
        Route::get('/{role}', 'RoleController@read')->name('read');
        Route::put('/{role}', 'RoleController@update')->name('update');
        Route::delete('/{role}', 'RoleController@delete')->name('delete');
    });
});
