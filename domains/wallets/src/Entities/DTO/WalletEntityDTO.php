<?php

namespace Wallets\Entities\DTO;

class WalletEntityDTO
{
    private ?int $id;
    private string $name;
    private int $userId;
    private string $description;
    private float $balance;
    private string $currency;
    private string $privateComment;
    private string $comment;
    private ?int $ownerId;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'];
        $this->userId = $data['userId'];
        $this->description = $data['description'] ?? '';
        $this->balance = $data['balance'] ?? 0;
        $this->currency = $data['currency'] ?? '';
        $this->privateComment = $data['privateComment'] ?? '';
        $this->comment = $data['comment'] ?? '';
        $this->ownerId = $data['ownerId'] ?? 0;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getPrivateComment()
    {
        return $this->privateComment;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }
}

