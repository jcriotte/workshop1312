<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    private $faker;
    
    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();
        // $product = new Product();
        // $manager->persist($product);

        for($i = 0; $i < 20; $i++)
        {
            $manager->persist(
                (new Product())
                    ->setName($this->faker->words(3, true))
                    ->setDescription($this->faker->sentences(3, true))
                    ->setPrice($this->faker->randomFloat(2, 10, 100))
                    ->setPictureUrl($this->faker->imageUrl(640, 480, 'products'))
            );
        }

        $manager->flush();
    }
}
