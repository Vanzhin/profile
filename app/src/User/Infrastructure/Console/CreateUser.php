<?php
declare(strict_types=1);


namespace App\User\Infrastructure\Console;

use App\User\Domain\Factory\UserFactory;
use App\User\Infrastructure\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

#[AsCommand(name: 'app:user:create-user', description: 'create user')]
final class CreateUser extends Command
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly UserFactory    $factory
    )
    {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $validator = Validation::createValidator();
        $email = $io->ask('email',
            null,
            function (?string $input) use ($validator) {
                $violations = $validator->validate($input, [new Email()]);
                if (0 !== $violations->count()) {
                    throw new \Exception($violations->get(0)->getMessage());
                }
                return $input;
            }
        );
        $password = $io->askHidden('password',
            function (?string $input) use ($validator) {
                $violations = $validator->validate($input, [new NotBlank(['allowNull'=>true])]);
                if (0 !== $violations->count()) {
                    throw new \Exception($violations->get(0)->getMessage());
                }
                return $input;
            }
        );
        $user = $this->factory->create($email, $password);
        $this->repository->add($user);

        return Command::SUCCESS;
    }
}