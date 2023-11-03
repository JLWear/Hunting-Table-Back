<?php

namespace App\DataFixtures;

use App\Entity\Kill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Generator;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\SpecieFixtures;
use App\DataFixtures\HuntFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class KillFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var Generator
     */

     private $faker;

     public function __construct()
     {
         $this->faker = Factory::create("fr_FR");
     }

    public function load(ObjectManager $manager)
    {
        $kill = New Kill();

        $kill->setNumber($this->faker->randomDigit());
        $kill->setSpecie($this->getReference(SpecieFixtures::SPECIE));
        $kill->setHunt($this->getReference(HuntFixtures::HUNT));
        $manager->persist($kill);

        $manager->flush();
            
    }

    public function getDependencies()
    {
        return [
            SpecieFixtures::class,
            HuntFixtures::class,
        ];
    }
}