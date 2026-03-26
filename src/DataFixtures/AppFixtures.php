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
            ['name' => '3-gangen diner bij De Post', 'price' => 19.50, 'desc' => 'Geniet van een heerlijk diner in hartje stad.'],
            ['name' => 'Entree Wellness Resort', 'price' => 12.95, 'desc' => 'Hele dag ontspannen in de sauna en baden.'],
            ['name' => 'Wasbeurt Auto "Goud"', 'price' => 7.50, 'desc' => 'Je auto weer als nieuw inclusief hot wax.'],
        ];

        foreach ($deals as $dealData) {
            $product = new Product();
            $product->setName($dealData['name']);
            $product->setPrice($dealData['price']);
            $product->setDescription($dealData['desc']);
            
            $manager->persist($product);
        }

        $manager->flush(); // Schrijf alles in één keer naar de database
    }
}
