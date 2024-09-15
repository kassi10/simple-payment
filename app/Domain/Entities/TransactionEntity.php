<?php
namespace App\Domain\Entities;

class TransactionEntity
{
    private int $senderId;
    private int $receiverId;
    private float $amount;

    public function __construct($senderId, $receiverId, float $amount)
    {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->amount = $amount;
    }


    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
