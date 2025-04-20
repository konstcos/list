<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::match(['post', 'option'], '/login', [AuthController::class, 'login'])->name('login');
    Route::match(['post', 'option'], '/register', [AuthController::class, 'register'])->name('register');

    Route::middleware('auth:sanctum')->group(function() {
        Route::match(['post', 'option'], '/user', [UserController::class, 'userData'])->name('userData');
        Route::match(['post', 'option'], '/logout', [AuthController::class, 'logout'])->name('logout');

        require_once __DIR__ . '/../domains/wallets/routes/wallet.routes.php';
        require_once __DIR__ . '/../domains/links/routes/links.routes.php';
        require_once __DIR__ . '/../domains/taxonomy/routes/taxonomy.routes.php';
    });
});


