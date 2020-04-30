<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return 'works';
});


/**
 * Auth API Routes
 */
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController');
    Route::post('logout', 'LogoutController');
    Route::get('me', 'MeController');

});

Route::resource('categories', 'Category\CategoryController');
