<?php

namespace Wallets\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Wallets\UseCases\WalletUseCase;
use Illuminate\Http\JsonResponse;
use Wallets\Entities\DTO\WalletEntityDTO;

class WalletController extends BaseController
{

    public function userWallets(Request $request, WalletUseCase $walletUseCase): JsonResponse
    {
        $userId = $request->user()->id;
        $result = $walletUseCase->getUserWallets($userId);

        return response()->json([
            'status' => $result['status'],
            'info' => $result['info'],
            'data' => $result['data'],
        ]);
    }

    public function saveUserWallet(Request $request, WalletUseCase $walletUseCase): JsonResponse
    {
        if (trim($request->input('name')) === '') {
            return response()->json([
                'status' => 'fail',
                'info' => 'name is required',
                'data' => [],
            ]);
        }

        $dto = new WalletEntityDTO([
            'id' => $request->integer('id'),
            'name' => $request->input('name'),
            'userId' => $request->user()->id,
            'description' => $request->input('description'),
            'balance' => $request->input('balance'),
            'currency' => $request->input('currency'),
            'privateComment' => $request->input('privateComment'),
            'comment' => $request->input('comment'),
            'ownerId' => $request->user()->id,
        ]);
        $result = $walletUseCase->saveUserWallet($dto);

        return response()->json([
            'status' => $result['status'],
            'info' => $result['info'],
            'data' => $result['data'],
        ]);
    }

}
