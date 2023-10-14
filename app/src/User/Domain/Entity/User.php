<?php

namespace App\User\Domain\Entity;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Shared\Domain\Service\UlidService;
use \App\User\Domain\Service\UserPasswordHasherInterface;

class User implements AuthUserInterface
{
    private string $ulid;
    private string $email;
    private ?string $password = null;
    private array $roles = [];

    /**
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->ulid = UlidService::generate();
        $this->email = $email;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function setPassword(?string $password, UserPasswordHasherInterface $hasher): void
    {
        if (!$password) {
            $this->password = null;
        }
        $this->password = $hasher->hash($this, $password);
    }
}