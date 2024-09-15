<?php

namespace App\UseCase;

use App\Domain\Entities\TransactionEntity;
use App\Domain\Repositories\UserRepository;
use App\Domain\Repositories\TransactionRepository;
use App\Domain\Repositories\TransactionRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TransactionUseCase
{
    private UserRepositoryInterface $userRepository;
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(UserRepositoryInterface $userRepository, TransactionRepositoryInterface $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function execute($senderId, $receiverId, $amount)
    {
        $sender = $this->userRepository->find($senderId);
        $receiver = $this->userRepository->find($receiverId);

        if (!$sender || !$receiver) {
            throw new \Exception('Sender or receiver not found');
        }

        if (!$sender->hasEnoughBalance($amount)) {
            throw new \Exception('Insufficient balance');
        }

        if(!$sender->canSendMoney()) {
            throw new \Exception('Sender cannot send money');
        }
        if($receiver->getId() == $sender->getId()) {
            throw new \Exception('Sender cannot is the same that receiver');
        }


        DB::beginTransaction();

        try {
                $sender->deductBalance($amount);
                $receiver->addBalance($amount);
                
        
             //  Persist the updated balances
                $this->userRepository->update($sender);
                $this->userRepository->update($receiver);
        
                //Create and save the transaction
               $transactionEntity = new TransactionEntity($senderId, $receiverId, $amount);
               $this->transactionRepository->save($transactionEntity);
                
                DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
}