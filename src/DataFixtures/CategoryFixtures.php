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
        $jouets->setDescription('Retrouvez ici tous nos jouets et jeux traditionnels divers');
        $manager->persist($jouets);

        $vetements = new Category();
        $vetements->setTitle('Vetements');
        $vetements->setDescription('Retrouvez ici tous nos vetements et accessoires de mode');
        $manager->persist($vetements);
        $this->addReference(self::CATEGORY_VETEMENTS, $vetements);


        $peluches = new Category();
        $peluches->setTitle('Peluches');
        $peluches->setDescription('Retrouvez ici nos peluches et doudous');
        $peluches->setParent($jouets);
        $manager->persist($peluches);
        $this->addReference(self::CATEGORY_PELUCHES, $peluches);

        $hightech = new Category();
        $hightech->setTitle('High Tech');
        $hightech->setDescription('Retrouvez ici nos accessoires high-tech et jeux videos');

        $manager->persist($hightech);

        $manager->flush();
    }
}
