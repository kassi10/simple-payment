<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\TransactionEntity;

interface TransactionRepositoryInterface
{
    public function save(TransactionEntity $transaction): void;
}