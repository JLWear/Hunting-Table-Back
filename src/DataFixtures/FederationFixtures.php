<?php

namespace App\DataFixtures;

use App\Entity\Federation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\DepartmentFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FederationFixtures extends Fixture implements DependentFixtureInterface
{

     public const FEDERATION = 'fed';

    public function load(ObjectManager $manager)
    {
        $federation = New Federation();

        $federation->setName('Fédération de chasse de Cote d\'Or');
        $federation->setDepartment($this->getReference(DepartmentFixtures::DEPARTMENT));
        $manager->persist($federation);

        $manager->flush();

        $this->addReference(self::FEDERATION, $federation);
            
    }

    public function getDependencies()
    {
        return [
            DepartmentFixtures::class,
        ];
    }
}