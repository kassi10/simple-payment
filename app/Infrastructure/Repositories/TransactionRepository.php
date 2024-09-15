<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\TransactionEntity;
use App\Domain\Repositories\TransactionRepositoryInterface;
use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function save(TransactionEntity $transaction): void
    {
        $transactionModel = new Transaction();

        $transactionModel->sender_id = $transaction->getSenderId();
        $transactionModel->receiver_id = $transaction->getReceiverId();
        $transactionModel->amount = $transaction->getAmount();

        $transactionModel->save();
    }
}
