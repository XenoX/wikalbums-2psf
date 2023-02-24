<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);

            $this->addReference($categoryName, $category);

            $manager->persist($category);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            'rap',
            'rock',
            'pop',
            'metal',
        ];
    }
}
