<?php

namespace App\DataFixtures;

use App\Entity\ProductImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $productImage = new ProductImage();
        $productImage->setPath('ane-en-peluche.jpg');
        $productImage->setPosition(1);
        $productImage->setProduct($this->getReference(ProductFixtures::PRODUCT_DONKEY_PELUCHE));
        $manager->persist($productImage);

        $productImage2 = new ProductImage();
        $productImage2->setPath('ane-orak.jpg');
        $productImage2->setPosition(1);
        $productImage2->setProduct($this->getReference(ProductFixtures::PRODUCT_DONKEY_MANTEAU));
        $manager->persist($productImage2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
