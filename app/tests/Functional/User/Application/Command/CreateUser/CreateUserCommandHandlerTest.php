<?php

namespace App\Tests\Functional\User\Application\Command\CreateUser;

use App\Shared\Application\Command\CommandBusInterface;
use App\User\Application\Command\CreateCommand\CreateUserCommand;
use App\User\Domain\Repository\UserRepositoryInterface;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateUserCommandHandlerTest extends WebTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->commandBus = $this::getContainer()->get(CommandBusInterface::class);
        $this->userRepository = $this::getContainer()->get(UserRepositoryInterface::class);
    }

    public function test_user_created_successfully():void
    {
        $command = new CreateUserCommand($this->faker->email(), $this->faker->password());
        $userUlid = $this->commandBus->execute($command);

        $user = $this->userRepository->findByUlid($userUlid);
        $this->assertNotEmpty($user);
    }
}
