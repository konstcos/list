<?php

use Illuminate\Support\Facades\Route;
use Wallets\Http\Controllers\WalletController;

Route::group(['prefix' => 'wallet'], function () {
    Route::match(
        ['post', 'option'],
        '/user-wallets',
        [WalletController::class, 'userWallets']
    )->name('userWallets');
});

Route::group(['prefix' => 'wallet'], function () {
    Route::match(
        ['post', 'option'],
        '/save',
        [WalletController::class, 'saveUserWallet']
    )->name('saveUserWallet');
});




