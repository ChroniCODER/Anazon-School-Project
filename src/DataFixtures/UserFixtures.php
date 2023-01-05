<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPlainPassword('demo');
        //$user->setPassword('$2y$13$QViqjjUzI6QmlJgh4ma3L.2BwH8p357rLA47VHNcW5yeDGPdGSwYa'); // demo
        $manager->persist($user);

        $manager->flush();
    }
}
