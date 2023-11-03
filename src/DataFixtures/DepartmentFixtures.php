<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{

    public const DEPARTMENT = 'dept';

    public function load(ObjectManager $manager): void
    {

        $department = New Department();

        $department->setName('Cote d\'or');
        $department->setNumber(21);
        $manager->persist($department);   

        $manager->flush();

        $this->addReference(self::DEPARTMENT, $department);
    }
}