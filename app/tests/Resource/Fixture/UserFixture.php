<?php
declare(strict_types=1);

namespace App\Tests\Resource\Fixture;

use App\Tests\Tool\FakerTool;
use App\User\Domain\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    const REFERENCE = 'user';
    use FakerTool;

    public function __construct(private readonly UserFactory $userFactory)
    {
    }


    public function load(ObjectManager $manager)
    {
        $user = $this->userFactory->create($this->getFaker()->email(), $this->getFaker()->password());
        $manager->persist($user);
        $manager->flush();
        $this->addReference(self::REFERENCE, $user);
    }
}