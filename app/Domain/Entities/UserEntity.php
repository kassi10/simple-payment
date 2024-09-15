<?php

namespace App\Domain\Entities;

class UserEntity
{

    private int $id;
    private string $name;
    private string $cpfCnpj;
    private string $email;
    private string $password;
    private string $type; // 'common' or 'seller'
    private float $balance;

    public function __construct($id ,$name, $cpfCnpj, $email, $password, $type, $balance = 0)
    {
        if($id) {
            $this->id = $id;
            
        }
        $this->name = $name;
        $this->cpfCnpj = $cpfCnpj;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
        $this->balance = $balance;
    }

    public function isSeller(): bool
    {
        return $this->type === 'seller';
    }

    public function canSendMoney(): bool
    {
        return !$this->isSeller();
    }

    public function hasEnoughBalance(float $amount): bool
    {
        return $this->balance >= $amount;
    }

    public function deductBalance(float $amount): void
    {
        if (!$this->hasEnoughBalance($amount)) {
            throw new \Exception('Balance is not enough');
        }
        $this->balance -= $amount;
    }

    public function addBalance(float $amount): void
    {
        $this->balance += $amount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCpfCnpj(): string
    {
        return $this->cpfCnpj;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
