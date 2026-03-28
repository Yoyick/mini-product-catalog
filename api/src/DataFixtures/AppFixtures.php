<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $deals = [
            ['name' => '3-gangen diner bij De Post', 'price' => 19.50, 'desc' => 'Geniet van een heerlijk diner.'],
            ['name' => 'Entree Wellness Resort', 'price' => 12.95, 'desc' => 'Hele dag ontspannen.'],
            ['name' => 'Wasbeurt Auto "Goud"', 'price' => 7.50, 'desc' => 'Je auto weer als nieuw.'],
        ];

        for ($i = 1; $i <= 20; $i++) {            
            $dealData = $deals[$i % count($deals)];

            $product = new Product();            
            $product->setName($dealData['name'] . ' #' . $i);
            $product->setPrice($dealData['price'] + rand(0, 10));
            $product->setDescription($dealData['desc']);
            $product->setStock(rand(0, 100));            
            $manager->persist($product);
        }

        $manager->flush(); 
    }

}
