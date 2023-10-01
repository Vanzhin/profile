<?php
declare(strict_types=1);


namespace App\Shared\Application\Command;

use Symfony\Component\Console\Tester\Constraint\CommandIsSuccessful;

interface CommandBusInterface
{
    public function execute(CommandInterface $command):mixed;
}