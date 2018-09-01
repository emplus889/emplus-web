<?php

use Illuminate\Http\Request;

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

Route::group(['prefix'=>'v1','middleware' => ['auth:api','cors']], function(){
    
    // auth
    Route::group(['prefix'=>'auth'], function(){
        Route::get('/getUser', 'AuthController@getUser');
        Route::post('/logout', 'AuthController@logout');
    });

    // wallet
    Route::group(['prefix'=>'wallet'], function(){
        Route::get('/getBalance/{id}', 'WalletController@getBalance');
        Route::post('/createWallet', 'WalletController@storeWallet');
        Route::post('/checkWalletNo', 'WalletController@checkWalletNo');
        Route::post('/addBalance', 'WalletController@addBalance');
        Route::post('/transferBalance', 'WalletController@transferBalance');
    });

    // transaction
    Route::group(['prefix'=>'transaction'], function(){
        Route::get('/index/{id}', 'TransactionController@index');
    });
});
