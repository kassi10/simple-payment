<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class UserRepository implements UserRepositoryInterface
{
    public function __construct() {
        
    }
    public function find(int $id): ?UserEntity
    {
        $user = User::find( $id);
        if (!$user) {
            return null;
        }
        $idEntity = new UserEntity(
            $user->id,
            $user->name,
            $user->cpf_cnpj,
            $user->email,
            $user->password,
            $user->type,
            $user->balance
        );

        $idEntity->getId();

        return new UserEntity(
            $user->id,
            $user->name,
            $user->cpf_cnpj,
            $user->email,
            $user->password,
            $user->type,
            $user->balance
        );
    }

    public function update(UserEntity $user):void{

        $userModel = User::find( $user->getId());
        if (!$userModel) {
            throw new \Exception('User not found');
        }
            
        $userModel->name = $user->getName();
        $userModel->cpf_cnpj = $user->getCpfCnpj();
        $userModel->email = $user->getEmail();
        $userModel->password = $user->getPassword();
        $userModel->type = $user->getType();
        $userModel->balance = $user->getBalance();
        
        $userModel->save();
    }


    public function save(UserEntity $user): void
    {    
        $userModel = new User();
        $userModel->name = $user->getName();
        $userModel->cpf_cnpj = $user->getCpfCnpj();
        $userModel->email = $user->getEmail();
        $userModel->password = $user->getPassword();
        $userModel->type = $user->getType();
        $userModel->balance = $user->getBalance();
        
        $userModel->save();
    }


    public function user_exists(UserEntity $user): bool
    {
        $userModel = DB::select("
            SELECT id FROM users WHERE email = :email OR cpf_cnpj = :cpf_cnpj LIMIT 1", 
            [
                'email' => $user->getEmail(),
                'cpf_cnpj' => $user->getCpfCnpj()
            ]
        );

        if($userModel) {
            return true;
        }

        return false;
    }
}
