<?php

declare(strict_types=1);

namespace App\Repository;

use App\Playground\User\User;

interface UserRepository
{
    public function findById(string $id): ?User;

    /**
     * @return User[]
     */
    public function findAll(): array;

    public function save(User $user): void;
}
