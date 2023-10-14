<?php
declare(strict_types=1);


namespace App\Shared\Infrastructure\Security;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use Symfony\Bundle\SecurityBundle\Security;

class UserFetcher implements UserFetcherInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function getAuthUser(): AuthUserInterface
    {
        $user = $this->security->getUser();
        if (!$user) {
            throw new \Exception('User not found.');
        }

        return $user;
    }
}