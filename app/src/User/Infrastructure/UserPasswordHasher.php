<?php
declare(strict_types=1);


namespace App\User\Infrastructure;

use App\User\Domain\Entity\User;
use App\User\Domain\Service\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as BaseUserPasswordHasher;

class UserPasswordHasher implements UserPasswordHasherInterface
{
    public function __construct(private readonly BaseUserPasswordHasher $hasher)
    {
    }

    public function hash(User $user, string $password): string
    {
        return $this->hasher->hashPassword($user, $password);
    }
}