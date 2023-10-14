<?php
declare(strict_types=1);


namespace App\User\Infrastructure\Controller;

use App\Shared\Domain\Security\UserFetcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users/me', 'user_me', methods: ['GET'])]
class GetMeAction
{
    public function __construct(private readonly UserFetcherInterface $fetcher)
    {
    }

    public function __invoke()
    {
        $user = $this->fetcher->getAuthUser();

        return new JsonResponse([
            'ulid' => $user->getUlid(),
            'email' => $user->getEmail(),
        ]);
    }
}