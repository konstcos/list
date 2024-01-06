<?php

use Illuminate\Support\Facades\Route;
use Wallets\Http\Controllers\WallerController;

Route::group(['prefix' => 'wallet'], function () {
    Route::match(
        ['post', 'option'],
        '/user-wallets',
        [WallerController::class, 'userWallets']
    )->name('userWallets');
});
