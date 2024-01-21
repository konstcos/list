<?php

namespace Wallets\UseCases;

use Wallets\Repositories\WalletRepository;
use Wallets\Entities\DTO\WalletEntityDTO;
use Wallets\Entities\WalletEntity;
use Wallets\Services\WalletDataService;


class WalletUseCase
{

    private $walletRepository;
    private $walletDataService;


    public function __construct(
        WalletRepository $walletRepository, 
        WalletDataService $walletDataService)
    {
        $this->walletRepository = $walletRepository;
        $this->walletDataService = $walletDataService;

    }

    public function getUserWallets(int $userId)
    {

        try {
            $wallets = $this->walletDataService->getUserWalletsWithPublicData($userId);
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error getting user wallets',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'user wallets',
            'data' => [
                'wallets' => $wallets,
            ],
        ];
    }

    public function saveUserWallet(WalletEntityDTO $dto)
    {

        try {
            $walletEntity = WalletEntity::fromDTO($dto);
            $this->walletRepository->saveUserWallet($walletEntity);
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error saving user wallet',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'user wallet saved',
            'data' => [],
        ];
    }

    public function deleteUserWallet(int $userId, int $walletId)
    {
        return [

        ];
    }
}
