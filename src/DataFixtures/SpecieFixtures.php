<?php

namespace App\DataFixtures;

use App\Entity\Specie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SpecieFixtures extends Fixture implements DependentFixtureInterface
{

     public const SPECIE = 'specie';

    public function load(ObjectManager $manager)
    {
        $specie = New Specie();

        $specie->setName('Sanglier');
        $specie->setCategory($this->getReference(CategoryFixtures::CATEGORY));
        $manager->persist($specie);

        $manager->flush();

        $this->addReference(self::SPECIE, $specie);
            
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}