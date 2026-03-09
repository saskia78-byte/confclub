<?php

namespace App\DataFixtures;

use App\Factory\ConfFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ConfFactory::createMany(5);
    }
}
