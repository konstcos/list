<?php

namespace Wallets\Services;

use WalletEntities\WalletEntity;
use Wallets\Repositories\WalletRepository;


class WalletDataService
{
    private $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function getUserWalletsWithPublicData($userId): array {
        $wallets = [];

        $userDBWallets = $this->walletRepository->getUserWalletsWithFullData($userId);

        foreach ($userDBWallets as $userDBWallet) {
            $wallets[] = [
                'id' => $userDBWallet['id'],
                'name' => $userDBWallet['name'],
                'description' => $userDBWallet['description'],
                'balance' => $userDBWallet['balance'],
                'currency' => $userDBWallet['currency'],
                'privateComment' => $userDBWallet['private_comment'],
                'comment' => $userDBWallet['comment'],
                'createdAt' => $userDBWallet['created_at'],
                'updatedAt' => $userDBWallet['updated_at'],
                'deletedAt' => $userDBWallet['deleted_at'],
                'user' => [
                    'id' => $userDBWallet['user_id'],
                    // 'name' => $userDBWallet['user_name'],
                ],
                'owner' => [
                    'id' => $userDBWallet['owner_id'],
                    // 'name' => $userDBWallet['owner_name'],
                ],
            ];
        }

        return $wallets;
    }

    public function getUserWalletWithPublicData($userId, $walletId): array {

        $userDBWallet = $this->walletRepository->getUserWalletWithFullData($userId, $walletId);
        
        if (!$userDBWallet) {
            return false;
        }

        return [
            'id' => $userDBWallet['id'],
            'name' => $userDBWallet['name'],
            'description' => $userDBWallet['description'],
            'balance' => $userDBWallet['balance'],
            'currency' => $userDBWallet['currency'],
            'privateComment' => $userDBWallet['private_comment'],
            'comment' => $userDBWallet['comment'],
            'createdAt' => $userDBWallet['created_at'],
            'updatedAt' => $userDBWallet['updated_at'],
            'deletedAt' => $userDBWallet['deleted_at'],
            'user' => [
                'id' => $userDBWallet['user_id'],
                // 'name' => $userDBWallet['user_name'],
            ],
            'owner' => [
                'id' => $userDBWallet['owner_id'],
                // 'name' => $userDBWallet['owner_name'],
            ],
        ];
    }

    public function getWalletPublicData(WalletEntity $wallet)
    {
        $walletData = [
            'id' => $wallet->id,
            'name' => $wallet->name,
            'description' => $wallet->description,
            'balance' => $wallet->balance,
            'currency' => $wallet->currency,
            'privateComment' => $wallet->private_comment,
            'comment' => $wallet->comment,
            'createdAt' => $wallet->created_at,
            'updatedAt' => $wallet->updated_at,
            'deletedAt' => $wallet->deleted_at,
            'userId' => $wallet->user_id,
            'ownerId' => $wallet->owner_id,
        ];
        return $walletData;
    }
}