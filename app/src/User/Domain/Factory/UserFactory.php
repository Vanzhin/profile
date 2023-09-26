<?php

namespace App\User\Domain\Factory;

use App\User\Domain\Entity\User;

class UserFactory
{

    public function create(string $email, string $password): User
    {
        return new User($email, $password);
    }
}