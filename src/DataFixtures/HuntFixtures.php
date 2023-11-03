<?php

namespace App\DataFixtures;

use App\Entity\Hunt;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use App\DataFixtures\SocietyFixtures;
use App\DataFixtures\HunterFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class HuntFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var Generator
     */

     private $faker;

     public function __construct()
     {
         $this->faker = Factory::create("fr_FR");
     }

     public const HUNT = 'hunt';

    public function load(ObjectManager $manager)
    {
        $hunt = New Hunt();

        $hunt->setDate($this->faker->dateTime());
        $hunt->setHunter($this->getReference(HunterFixtures::HUNTER));
        $hunt->setSociety($this->getReference(SocietyFixtures::SOCIETY));
        $hunt->addParticipant($this->getReference(HunterFixtures::HUNTER));
        $hunt->setTitle($this->faker->title());
        $hunt->setDescription($this->faker->sentence());
        $manager->persist($hunt);

        $manager->flush();

        $this->addReference(self::HUNT, $hunt);
            
    }

    public function getDependencies()
    {
        return [
            SocietyFixtures::class,
            HunterFixtures::class,
        ];
    }
}