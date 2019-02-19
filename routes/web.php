<?php

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

Route::get('/', function () {
    return view('welcome');
});


// Authentication
Auth::routes();
Route::get('register/functions/get/{id}', 'Auth\RegisterController@getFunctions');

// Pages
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/instructions', 'InstructionsController@index')->name('instructions');
Route::get('/clock-in', 'ClockingController@index')->name('clocking');
Route::prefix('panel')->group(function () {
    Route::get('/', 'DashboardController@index')->name('panel_index');
    Route::get('/employees', 'UsersController@index')->name('panel_users');
    // Add
    Route::get('/employees/add', 'UsersController@create')->name('panel_users_create');
    // Show
    Route::get('/employees/{id}', 'UsersController@show')->name('panel_users_show');
    // Edit
    Route::get('/employees/{id}/edit', 'UsersController@edit')->name('panel_users_edit');
    Route::get('/employees/{id}/edit/functions/get/{department_id}', 'UsersController@getFunctions');
    // Update
    Route::put('/employees/{id}/update', 'UsersController@update')->name('panel_users_update');
    // Delete
    Route::delete('/employees/{id}/delete', 'UsersController@destroy')->name('panel_users_delete');
    // Clocking
    Route::get('/employees/{id}/clockings', 'ClockingsController@create')->name('panel_users_clockings');
    Route::post('/employees/{id}/clockings', 'ClockingsController@store')->name('panel_users_clockings_store');
    Route::delete('/employees/{id}/clockings/{clocking_id}/delete', 'ClockingsController@destroy')->name('panel_users_clockings_delete');
});
Route::get('/settings', 'SettingsController@index')->name('settings');