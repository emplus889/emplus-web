<?php

use Illuminate\Http\Request;

Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');

Route::group(['prefix'=>'v1','middleware' => 'auth:api'], function(){
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
