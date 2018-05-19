<?php

use Illuminate\Http\Request;

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

Route::group(['prefix'=>'v1','middleware' => 'auth:api'], function(){
    
    // auth
    Route::post('/logout', 'AuthController@logout');

    // user
    Route::get('/userId', 'UserController@userId');
    Route::get('/profile', 'UserController@profile');
    Route::post('/details', 'UserController@details');
    Route::post('/getFotoProfil/{id}', 'UserProfileController@getFotoProfil');

    // wallet
    Route::get('/getBalance/{id}', 'WalletController@getBalance');
    Route::post('/createWallet', 'WalletController@storeWallet');
    Route::post('/checkWalletNo', 'WalletController@checkWalletNo');
    Route::post('/addBalance', 'WalletController@addBalance');
    Route::post('/transferBalance', 'WalletController@transferBalance');
});
