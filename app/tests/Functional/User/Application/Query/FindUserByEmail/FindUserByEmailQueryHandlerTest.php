<?php

namespace App\Tests\Functional\User\Application\Query\FindUserByEmail;

use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\Resource\Fixture\UserFixture;
use App\User\Application\DTO\UserDTO;
use App\User\Application\Query\FindUserByEmail\FindUserByEmailQuery;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Infrastructure\Repository\UserRepository;
use Faker\Factory;
use Faker\Generator;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FindUserByEmailQueryHandlerTest extends WebTestCase
{
    private UserRepository $userRepository;
    private Generator $faker;
    private AbstractDatabaseTool $databaseTool;
    private QueryBusInterface $queryBus;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->queryBus = $this::getContainer()->get(QueryBusInterface::class);
        $this->userRepository = $this::getContainer()->get(UserRepositoryInterface::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function test_user_created_when_command_executed(): void
    {
//        arrange
        $referenceRepository = $this->databaseTool->loadFixtures([UserFixture::class])->getReferenceRepository();
        $user = $referenceRepository->getReference(UserFixture::REFERENCE);
        $query = new FindUserByEmailQuery($user->getEmail());
//        act
        $userDTO = $this->queryBus->execute($query);
//        assert
        $this->assertInstanceOf(UserDTO::class, $userDTO);
    }
}
