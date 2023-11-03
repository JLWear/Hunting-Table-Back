<?php

namespace App\DataFixtures;

use App\Entity\Hunter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use App\DataFixtures\SocietyFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class HunterFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var Generator
     */

     private $faker;

     public function __construct()
     {
         $this->faker = Factory::create("fr_FR");
     }

    public const HUNTER = 'hunter';

    public function load(ObjectManager $manager)
    {
        $hunter = New Hunter();

        $hunter->setLastName($this->faker->lastName());
        $hunter->setFirstName($this->faker->firstName());
        $hunter->setBirthDate($this->faker->dateTime());
        // $hunter->setSociety($this->getReference(SocietyFixtures::SOCIETY));
        $manager->persist($hunter);

        $manager->flush();

        $this->addReference(self::HUNTER, $hunter);
            
    }

    public function getDependencies()
    {
        return [
            SocietyFixtures::class,
        ];
    }
}