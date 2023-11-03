<?php

namespace App\DataFixtures;

use App\Entity\Society;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\FederationFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SocietyFixtures extends Fixture implements DependentFixtureInterface
{

    public const SOCIETY = 'society';

    public function load(ObjectManager $manager)
    {
        $society = New Society();

        $society->setName('Société de chasse de Rouvres en Plaine');
        $society->setFederation($this->getReference(FederationFixtures::FEDERATION));
        $manager->persist($society);

        $manager->flush();

        $this->addReference(self::SOCIETY, $society);
            
    }

    public function getDependencies()
    {
        return [
            FederationFixtures::class,
        ];
    }
}