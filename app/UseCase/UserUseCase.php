<?php

namespace App\UseCase;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Entities\UserEntity;

class UserUseCase
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function find(int $id): ?UserEntity
    {
        return $this->userRepository->find($id);
    }

    // Neste caso do save o user poderia ser criado um tipo, por exemplo userInputDTO
    public function save($user): void
    {
        $user = new UserEntity(
            null,
            $user['name'], 
            $user['cpf_cnpj'], 
            $user['email'], 
            $user['password'], 
            $user['type'], 
            $user['balance']
        );
        $user_exists = $this->userRepository->user_exists($user);
        if ($user_exists) {
            throw new \Exception('User already exists');
        }
        $this->userRepository->save($user);
    }
}
