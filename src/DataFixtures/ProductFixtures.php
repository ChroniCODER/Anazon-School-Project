<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_DONKEY_PELUCHE = 'PRODUCT_DONKEY_PELUCHE';
    public const PRODUCT_DONKEY_MANTEAU = 'PRODUCT_DONKEY_MANTEAU';
    
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Super peluche de donkey');
        $product->setCategory($this->getReference(CategoryFixtures::CATEGORY_PELUCHES));
        $product->setPrice(12.23);
        $manager->persist($product);
        $this->addReference(self::PRODUCT_DONKEY_PELUCHE, $product);

        $product2 = new Product();
        $product2->setName('Ane-Orak DonkeyCode');
        $product2->setCategory($this->getReference(CategoryFixtures::CATEGORY_VETEMENTS));
        $product2->setPrice(49.99);
        $manager->persist($product2);
        $this->addReference(self::PRODUCT_DONKEY_MANTEAU, $product2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
