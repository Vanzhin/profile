<?php
declare(strict_types=1);


namespace App\User\Application\Command\CreateCommand;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\User\Domain\Factory\UserFactory;
use App\User\Domain\Repository\UserRepositoryInterface;

class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $repository, private readonly UserFactory $userFactory)
    {
    }

    public function __invoke(CreateUserCommand $command): string
    {
        $user = $this->userFactory->create($command->email, $command->password);
        $this->repository->add($user);
        return $user->getUlid();
    }
}