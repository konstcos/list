<?php

use Illuminate\Support\Facades\Route;
use Wallets\Http\Controllers\WalletController;

Route::group(['prefix' => 'wallet'], function () {
    Route::match(
        ['post', 'option'],
        '/user-wallets',
        [WalletController::class, 'userWallets']
    )->name('userWallets');

    Route::match(
        ['post', 'option'],
        '/detail',
        [WalletController::class, 'userWalletDetail']
    )->name('userWalletDetail');

    Route::match(
        ['post', 'option'],
        '/save',
        [WalletController::class, 'saveUserWallet']
    )->name('saveUserWallet');

    Route::match(
        ['post', 'option'],
        '/delete',
        [WalletController::class, 'deleteUserWallet']
    )->name('deleteUserWallet');

});
