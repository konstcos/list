<?php

namespace Wallets\Entities;
use Wallets\Entities\DTO\WalletEntityDTO;

/**
 * Class WalletEntity
 * Класс WalletEntity представляет сущность кошелька.
 * Он содержит информацию о кошельке, такую как идентификатор, баланс и валюта.
 * Класс предоставляет методы для получения и установки значений свойств кошелька.
 * 
 */
class WalletEntity
{
    public ?int $id;
    public string $name;
    public string $description;
    public float $balance;
    public string $currency;
    public string $privateComment;
    public string $comment;
    public string $createdAt;
    public string $updatedAt;
    public ?string $deletedAt;
    public int $userId;
    public int $ownerId;


    public static function fromArray($walletArray): WalletEntity
    {
        $wallet = new WalletEntity();
        $wallet->id = $walletArray['id'];
        $wallet->name = $walletArray['name'];
        $wallet->userId = $walletArray['user_id'];
        $wallet->description = $walletArray['description'];
        $wallet->balance = $walletArray['balance'];
        $wallet->currency = $walletArray['currency'];
        $wallet->privateComment = $walletArray['private_comment'];
        $wallet->comment = $walletArray['comment'];
        $wallet->createdAt = $walletArray['created_at'];
        $wallet->updatedAt = $walletArray['updated_at'];
        $wallet->deletedAt = $walletArray['deleted_at'];
        $wallet->ownerId = $walletArray['owner_id'];

        return $wallet;
    }

    public static function fromDTO(WalletEntityDTO $dto): WalletEntity
    {
        $wallet = new WalletEntity();
        $wallet->id = $dto->getId();
        $wallet->name = $dto->getName();
        $wallet->userId = $dto->getUserId();
        $wallet->description = $dto->getDescription();
        $wallet->balance = $dto->getBalance();
        $wallet->currency = $dto->getCurrency();
        $wallet->privateComment = $dto->getPrivateComment();
        $wallet->comment = $dto->getComment();
        $wallet->ownerId = $dto->getOwnerId();

        return $wallet;

    }

    // TODO public function toArray(): array

}
