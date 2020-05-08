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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'AuthController@user');
        Route::get('logout', 'AuthController@logout');
    });
});

Route::group(['middleware' => 'auth:api'], function () {

    Route::post('personaldata', 'ChildController@storePersonalData');
    Route::post('sizedata', 'ChildController@storeSizeData');
    Route::get('child', 'ChildController@listChild');

    Route::get('vaccines', 'VaccineController@listVaccines');
    Route::post('vaccine', 'VaccineController@storeVaccine');

    Route::post('family', 'FamilyController@registerFamily');
    Route::get('familyuserscolors', 'FamilyController@listColorUsers');

    Route::get('expenses', 'ExpenditureController@listExpenses');
    Route::post('expenses', 'ExpenditureController@storeExpenditure');
    Route::delete('expenses/{id}', 'ExpenditureController@deleteExpenditure');

    Route::get('tasks', 'TaskController@listTasks');
    Route::post('task', 'TaskController@storeTask');
    Route::delete('tasks/{id}', 'TaskController@deleteTask');

    Route::post('nannies', 'NannieController@getNannies');
});


