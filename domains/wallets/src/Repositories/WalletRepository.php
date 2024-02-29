<?php

namespace Wallets\Repositories;

use Wallets\Models\WalletUser;
use Wallets\Models\Wallet;
use Wallets\Entities\WalletEntity;
use Illuminate\Support\Facades\DB;

class WalletRepository
{

    public function getUserWallets($userId): array
    {
        $wallets = [];

        $userWallets = Wallet::query()->select(
            'wallets.id',
            'wallets.name',
            'wallets.description',
            'wallets.balance',
            'wallets.currency',
            'wallets.private_comment',
            'wallets.comment',
            'wallets.created_at',
            'wallets.updated_at',
            'wallets.deleted_at',
            'wallet_users.user_id',
            // 'users.name as owner_name'
            DB::raw('wallet_owner.user_id as owner_id'),
        )
            ->join('wallet_users', 'wallets.id', '=', 'wallet_users.wallet_id')
            ->join('users', 'wallet_users.user_id', '=', 'users.id')
            ->join('wallet_users as wallet_owner', function ($join) {
                $join->on('wallets.id', '=', 'wallet_owner.wallet_id')
                    ->where('wallet_owner.is_owner', '=', true);
            })
            
            ->where('wallet_users.user_id', '=', $userId)
            ->get()
            ->toArray();

        foreach ($userWallets as $userWallet) {
            $wallets[] = WalletEntity::fromArray($userWallet);
        }

        return $wallets;
    }


    public function getUserWalletWithFullData($userId, $walletId): ?Wallet
    {

        $wallet = Wallet::query()->select(
            'wallets.id',
            'wallets.name',
            'wallets.description',
            'wallets.balance',
            'wallets.currency',
            'wallets.private_comment',
            'wallets.comment',
            'wallets.created_at',
            'wallets.updated_at',
            'wallets.deleted_at',
            'wallet_users.user_id',
            // 'users.name as owner_name'
            DB::raw('wallet_owner.user_id as owner_id'),
        )
            ->join('wallet_users', 'wallets.id', '=', 'wallet_users.wallet_id')
            ->join('users', 'wallet_users.user_id', '=', 'users.id')
            ->join('wallet_users as wallet_owner', function ($join) {
                $join->on('wallets.id', '=', 'wallet_owner.wallet_id')
                    ->where('wallet_owner.is_owner', '=', true);
            })
            
            ->where('wallet_users.user_id', '=', $userId)
            ->where('wallets.id', '=', $walletId)
            ->first();


        return $wallet;
    }

    public function getUserWalletsWithFullData($userId): array
    {
        $wallets = Wallet::query()->select(
            'wallets.id',
            'wallets.name',
            'wallets.description',
            'wallets.balance',
            'wallets.currency',
            'wallets.private_comment',
            'wallets.comment',
            'wallets.created_at',
            'wallets.updated_at',
            'wallets.deleted_at',
            'wallet_users.user_id',
            // 'users.name as owner_name'
            DB::raw('wallet_owner.user_id as owner_id'),
        )
            ->join('wallet_users', 'wallets.id', '=', 'wallet_users.wallet_id')
            ->join('users', 'wallet_users.user_id', '=', 'users.id')
            ->join('wallet_users as wallet_owner', function ($join) {
                $join->on('wallets.id', '=', 'wallet_owner.wallet_id')
                    ->where('wallet_owner.is_owner', '=', true);
            })
            
            ->where('wallet_users.user_id', '=', $userId)
            ->get()
            ->toArray();


        return $wallets;
    }

    /**
     * @param WalletEntity $entity
     */
    public function saveUserWallet(WalletEntity $entity): array
    {

        if ($entity->id === 0) {
            $wallet = new Wallet();
            $wallet->name = $entity->name;
            $wallet->balance = 0;
            $wallet->save();
            $walletUser = new WalletUser();
            $walletUser->wallet_id = $wallet->id;
            $walletUser->user_id = $entity->userId;
            $walletUser->is_owner = true;
            $walletUser->save();
        } else {
            $wallet = Wallet::query()->find($entity->id);
            $walletUser = WalletUser::query()->where('wallet_id', '=', $wallet->id)
            ->where('user_id', '=', $entity->userId)
            ->first();
        }

        if ($wallet === null) {
            return [
                'status' => 'fail',
                'info' => 'wrong wallet id',
                'data' => [],
            ];
        }

        $wallet->name = $entity->name;
        $wallet->description = $entity->description;
        $wallet->balance = $entity->balance;
        $wallet->currency = $entity->currency;
        $wallet->comment = $entity->comment;
        
        if ($walletUser->is_owner) {
            $wallet->private_comment = $entity->privateComment;
        }

        $wallet->save();

        return [
            'status' => 'success',
            'info' => 'wallet saved',
            'data' => [
                'wallet' => $wallet,
                'walletUser' => $walletUser,
            ],
        ];

    }

    public function deleteUserWallet($userId, $walletId): array
    {
        $wallet = Wallet::query()->find($walletId);
        $walletUsers = WalletUser::query()->where('wallet_id', '=', $wallet->id)
            ->where('user_id', '=', $userId)
            ->get();

        if ($wallet === null) {
            return [
                'status' => 'fail',
                'info' => 'wrong wallet id',
                'data' => [],
            ];
        }

        foreach ($walletUsers as $walletUser) {
            $walletUser->delete();
        }

        $wallet->delete();

        return [
            'status' => 'success',
            'info' => 'wallet deleted',
            'data' => [],
        ];
    }

}
