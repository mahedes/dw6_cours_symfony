<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 20; $i++) {
            $product = new Product();
            $product->setName("Product " . $i);
            $product->setPrice(rand(5, 100));
            $product->setDescription("Lorem ipsum");
            $manager->persist($product);
        }

        $manager->flush();
    }
}
