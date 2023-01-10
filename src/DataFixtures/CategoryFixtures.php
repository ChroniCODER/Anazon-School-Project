<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_PELUCHES = 'CATEGORY_PELUCHES';
    public const CATEGORY_VETEMENTS = 'CATEGORY_VETEMENTS';

    public function load(ObjectManager $manager): void
    {
        $jouets = new Category();
        $jouets->setTitle('Jouets');
        $manager->persist($jouets);

        $vetements = new Category();
        $vetements->setTitle('Vetements');
        $manager->persist($vetements);
        $this->addReference(self::CATEGORY_VETEMENTS, $vetements);


        $peluches = new Category();
        $peluches->setTitle('Peluches');
        $peluches->setParent($jouets);
        $manager->persist($peluches);
        $this->addReference(self::CATEGORY_PELUCHES, $peluches);

        $balades = new Category();
        $balades->setTitle('Balades');
        $manager->persist($balades);

        $manager->flush();
    }
}
