<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Autentification
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


/*Main Page*/

Route::get('/', function () {
    return view('mainPage');
});

/*Admin Panel*/

Route::get('/adminPanel', 'AdminPanelController@admin');
Route::get('/adminPanel/userProfile-{id}', 'UserProfileController@show')->name('userProfile');
Route::get('/adminPanel/allUsers', 'AllUsersController@allUsers');

Route::get('/adminPanel/userProfile-{id}/edit', 'UserProfileController@edit')->name('userProfileEdit');
Route::post('/adminPanel/userProfile-{id}/edit', 'UserProfileController@update')->name('userProfileUpdate');
Route::delete('/adminPanel/userProfile-{id}/delete', 'UserProfileController@destroy')->name('userProfileDelete');
