<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use App\DataFixtures\HunterFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var Generator
     */

     private Generator $faker;

     public function __construct()
     {
         $this->faker = Factory::create("fr_FR");
     }

    public function load(ObjectManager $manager)
    {
        $user = New User();

        $user->setCity($this->faker->city());
        $user->setMail($this->faker->email());
        $user->setPassword('test');
        $user->setIsDeleted(false);
        $user->setHunter($this->getReference(HunterFixtures::HUNTER));
        $user->setDescription($this->faker->sentence());
        $manager->persist($user);

        $manager->flush();
            
    }

    public function getDependencies()
    {
        return [
            HunterFixtures::class,
        ];
    }
}