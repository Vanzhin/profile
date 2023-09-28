<?php
declare(strict_types=1);

namespace App\Tests\Tool;

use Faker\Factory;

trait FakerTool
{
    public function getFaker(): \Faker\Generator
    {
        return Factory::create();
    }
}