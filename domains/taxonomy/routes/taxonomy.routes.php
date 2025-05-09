<?php

use Illuminate\Support\Facades\Route;
use Taxonomy\Http\Controllers\CategoryController;

Route::group(['prefix' => 'taxonomy'], function () {

    Route::group(['prefix' => 'categories'], function () {
        Route::match(
            ['post', 'option'],
            '/user-categories',
            [CategoryController::class, 'userCategories']
        )
            ->name('userCategories')
            ->middleware('role:admin');

        Route::match(
            ['post', 'option'],
            '/save-category',
            [CategoryController::class, 'createOrUpdateCategory']
        )
            ->name('createOrUpdateCategory')
            ->middleware('role:admin');

        Route::match(
            ['post', 'option'],
            '/delete-category',
            [CategoryController::class, 'deleteCategory']
        )
            ->name('deleteCategory')
            ->middleware('role:admin');

        Route::match(
            ['post', 'option'],
            '/bind-material',
            [CategoryController::class, 'bindMaterialToCategories']
        )
            ->name('receiveCategories')
            ->middleware('role:admin');

        Route::match(
            ['post', 'option'],
            '/receive-category',
            [CategoryController::class, 'receiveCategories']
        )->name('receiveCategories');
    });
});
