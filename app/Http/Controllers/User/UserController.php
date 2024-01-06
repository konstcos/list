<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Получить данные пользователя.
     *
     * Этот метод получает данные пользователя.
     *
     * @param  Request  $request  Запрос с информацией о пользователе.
     * @return JsonResponse  JSON-ответ с данными пользователя.
     */
    public function userData(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'status' => 'success',
            'info' => 'user data',
            'data' => [
                'user' => $user->toMainArrayData()
            ],
        ]);
    }
}

