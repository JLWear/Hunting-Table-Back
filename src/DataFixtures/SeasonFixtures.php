<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Generator;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\SpecieFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var Generator
     */

     private $faker;

     public function __construct()
     {
         $this->faker = Factory::create("fr_FR");
     }
     public const SEASON = 'season';

    public function load(ObjectManager $manager)
    {
        $season = New Season();

        $season->setTitle($this->faker->title());
        $season->setStartDate($this->faker->dateTime());
        $season->setEndDate($this->faker->dateTime());
        $season->addSpecie($this->getReference(SpecieFixtures::SPECIE));
        $manager->persist($season);

        $manager->flush();

        $this->addReference(self::SEASON, $season);
            
    }

    public function getDependencies()
    {
        return [
            SpecieFixtures::class,
        ];
    }
}