<?php

use Illuminate\Support\Facades\Route;

Route::get('location', 'LocationController@index');
Route::post('location', 'LocationController@store');
// authentication
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('refresh', 'AuthController@refresh');
Route::get('users', 'AuthController@index');

Route::middleware('auth:api')->group( function () {
    Route::post('logout', 'AuthController@logout');
    Route::delete('account/{id}/delete', 'AuthController@destroy');
});

