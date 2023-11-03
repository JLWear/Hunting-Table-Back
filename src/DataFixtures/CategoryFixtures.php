<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{

    public const CATEGORY = 'category';

    public function load(ObjectManager $manager): void
    {

        $category = New Category();

        $category->setName('Grand Gibier');
        $manager->persist($category);   

        $manager->flush();

        $this->addReference(self::CATEGORY, $category);
    }
}