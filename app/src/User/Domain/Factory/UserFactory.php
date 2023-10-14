<?php

namespace App\User\Domain\Factory;

use App\User\Domain\Entity\User;
use App\User\Domain\Service\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function create(string $email, string $password = null): User
    {
        $user = new User($email);
        if ($password) {
            $user->setPassword($password, $this->hasher);
        }
        return $user;
    }
}