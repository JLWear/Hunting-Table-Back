<?php

namespace App\DataFixtures;

use App\Entity\Quota;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use App\DataFixtures\SocietyFixtures;
use App\DataFixtures\SpecieFixtures;
use App\DataFixtures\SeasonFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class QuotaFixtures extends Fixture implements DependentFixtureInterface
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
        $quota = New Quota();

        $quota->setSociety($this->getReference(SocietyFixtures::SOCIETY));
        $quota->setNumber($this->faker->randomDigit());
        $quota->setSpecie($this->getReference(SpecieFixtures::SPECIE));
        $quota->setSeason($this->getReference(SeasonFixtures::SEASON));
        $manager->persist($quota);

        $manager->flush();
            
    }

    public function getDependencies()
    {
        return [
            SocietyFixtures::class,
            SpecieFixtures::class,
            SeasonFixtures::class,
        ];
    }
}