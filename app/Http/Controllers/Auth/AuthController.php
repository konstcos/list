<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    /**
     * Login user
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $email = trim($request->get('email'));
        $password = trim($request->get('password'));

        if ($email === '' || $password === '') {
            return response()->json([
                'status' => 'fail',
                'info' => 'email or password is empty',
                'data' => [],
            ]);
        }

        $user = User::query()->where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'fail',
                'info' => 'invalid login details',
                'data' => [],
            ], 401);
        }


        if (!$user->comparePassword($password)) {
            return response()->json([
                'message' => 'Invalid login details',
            ], 401);
        }

        $token = $user->createToken('auth_token', [])->plainTextToken;

        return response()->json([
            'status' => 'success',
            'info' => 'user created',
            'data' => [
                'token' => $token,
            ],
        ]);
    }


    /**
     * Register new user
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $name = trim($request->get('name'));
        $email = trim($request->get('email'));
        $password = trim($request->get('password'));

        if ($email === '' || $password === '') {
            return response()->json([
                'status' => 'fail',
                'info' => 'email or password is empty',
                'data' => [],
            ]);
        }

        $checkUser = User::query()->where('email', $email)->first();

        if ($checkUser) {
            return response()->json([
                'status' => 'fail',
                'info' => 'user already exists',
                'data' => [],
            ]);
        }

        User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user = User::query()->where('email', $email)->first();

        $token = $user->createToken('auth_token', [])->plainTextToken;

        return response()->json([
            'status' => 'success',
            'info' => 'user created',
            'data' => [
                'token' => $token,
            ],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'info' => 'Token deleted',
            'data' => [],
        ]);
    }
}
