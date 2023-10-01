<?php
declare(strict_types=1);


namespace App\User\Application\Query\FindUserByEmail;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\User\Application\DTO\UserDTO;
use App\User\Domain\Repository\UserRepositoryInterface;

class FindUserByEmailQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    public function __invoke(FindUserByEmailQuery $query): ?UserDTO
    {
        $user = $this->repository->findByEmail($query->email);
        if (!$user) {
            return null;
        }
        return UserDTO::fromEntity($user);
    }
}