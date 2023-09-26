<?php

namespace App\Tests\Functional\User\Infrastructure\Repository;

use App\User\Domain\Factory\UserFactory;
use App\User\Infrastructure\Repository\UserRepository;
use Faker\Factory;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRepositoryTest extends WebTestCase
{
    private UserRepository $repository;
    private Generator $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = static::getContainer()->get(UserRepository::class);
        $this->faker = Factory::create();
    }

    public function test_user_added_successfully(): void
    {

        $user = (new UserFactory())->create($this->faker->email(), $this->faker->password());

//        act
        $this->repository->add($user);

//        assert
        $existingUser = $this->repository->findByUlid($user->getUlid());
        $this->assertEquals($existingUser->getUlid(), $user->getUlid());

    }
}