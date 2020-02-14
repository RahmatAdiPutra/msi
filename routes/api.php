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
        'prefix' => 'application',
        'as' => 'application.'
    ],function () {
        Route::get('/data', 'ApplicationController@data')->name('data');
        Route::post('/', 'ApplicationController@create')->name('create');
        Route::get('/{application}', 'ApplicationController@read')->name('read');
        Route::put('/{application}', 'ApplicationController@update')->name('update');
        Route::delete('/{application}', 'ApplicationController@delete')->name('delete');
    });

    Route::group([
        'prefix' => 'company',
        'as' => 'company.'
    ],function () {
        Route::get('/data', 'CompanyController@data')->name('data');
        Route::post('/', 'CompanyController@create')->name('create');
        Route::get('/{company}', 'CompanyController@read')->name('read');
        Route::put('/{company}', 'CompanyController@update')->name('update');
        Route::delete('/{company}', 'CompanyController@delete')->name('delete');
    });

    Route::group([
        'prefix' => 'department',
        'as' => 'department.'
    ],function () {
        Route::get('/data', 'DepartmentController@data')->name('data');
        Route::post('/', 'DepartmentController@create')->name('create');
        Route::get('/{department}', 'DepartmentController@read')->name('read');
        Route::put('/{department}', 'DepartmentController@update')->name('update');
        Route::delete('/{department}', 'DepartmentController@delete')->name('delete');
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

    Route::group([
        'prefix' => 'permission',
        'as' => 'permission.'
    ],function () {
        Route::get('/data', 'PermissionController@data')->name('data');
        Route::post('/relation', 'PermissionController@relation')->name('relation');
        Route::post('/', 'PermissionController@create')->name('create');
        Route::get('/{permission}', 'PermissionController@read')->name('read');
        Route::put('/{permission}', 'PermissionController@update')->name('update');
        Route::delete('/{permission}', 'PermissionController@delete')->name('delete');
    });
});
