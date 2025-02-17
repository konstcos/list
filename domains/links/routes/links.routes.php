<?php

use Illuminate\Support\Facades\Route;
use Links\Http\Controllers\LinkController;

Route::group(['prefix' => 'links'], function () {

    Route::match(
        ['post', 'option'],
        '/user-links',
        [LinkController::class, 'userLinks']
    )->name('userLinks');

    Route::match(
        ['post', 'option'],
        '/save-link',
        [LinkController::class, 'createOrUpdateLink']
    )->name('userLinks');



});
