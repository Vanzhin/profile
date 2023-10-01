<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    public function findByUlid(string $ulid): ?User;

    public function findByEmail(string $email): ?User;

}