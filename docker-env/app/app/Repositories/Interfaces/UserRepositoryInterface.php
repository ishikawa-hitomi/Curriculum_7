<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * 引数に渡されたメールアドレスを持つユーザーを取得する
     *
     * @param string $email
     * @return User
     */
    public function findFromEmail(string $email): User;
    public function updateUserPassword(string $password, int $id): void;
}