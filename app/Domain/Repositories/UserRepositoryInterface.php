<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\UserEntity;

interface UserRepositoryInterface
{
    public function find(int $id): ?UserEntity;

    public function save(UserEntity $user): void;

    public function user_exists(UserEntity $user): bool;

    public function update(UserEntity $user): void;
}