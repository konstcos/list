<?php

use Illuminate\Support\Facades\Route;
use Taxonomy\Http\Controllers\CategoryController;
use Taxonomy\Http\Controllers\TagsController;

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

    Route::group(['prefix' => 'tags'], function () {
        Route::match(
            ['post', 'option'],
            '/user-tags',
            [TagsController::class, 'userTags']
        )
            ->name('userTags')
            ->middleware('role:admin');

        Route::match(
            ['post', 'option'],
            '/save-tag',
            [TagsController::class, 'createOrUpdateTag']
        )
            ->name('createOrUpdateTags')
            ->middleware('role:admin');

        Route::match(
            ['post', 'option'],
            '/delete-tag',
            [TagsController::class, 'deleteTag']
        )
            ->name('deleteTags')
            ->middleware('role:admin');

        Route::match(
            ['post', 'option'],
            '/bind-tag',
            [TagsController::class, 'bindMaterialToTag']
        )
            ->name('bindMaterialToTags')
            ->middleware('role:admin');

        Route::match(
            ['post', 'option'],
            '/receive-tag',
            [TagsController::class, 'receiveTags']
        )->name('receiveTags');
    });
});
