<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AlbumFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            /** @var Artist $artist */
            $artist = $this->getReference($data[4]);

            $album = new Album();
            $album
                ->setName($data[0])
                ->setCover($data[1])
                ->setReleasedAt($data[2])
                ->setDescription($data[3])
                ->setArtist($artist)
            ;

            foreach ($data[5] as $categoryName) {
                /** @var Category $category */
                $category = $this->getReference($categoryName);

                $album->addCategory($category);
            }

            $this->addReference($data[0], $album);

            $manager->persist($album);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            ['Album_1', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages-na.ssl-images-amazon.com%2Fimages%2FI%2F91NQO2l3RZL._SL1500_.jpg&f=1&nofb=1&ipt=3a84754e4487cf41b08d67d1fcf7d7aa561ee927f1efa2b8248eb050cc986181&ipo=images', new \DateTimeImmutable(), 'Ma description', 'SCH', ['rap']],
            ['Album_2', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages-na.ssl-images-amazon.com%2Fimages%2FI%2F91NQO2l3RZL._SL1500_.jpg&f=1&nofb=1&ipt=3a84754e4487cf41b08d67d1fcf7d7aa561ee927f1efa2b8248eb050cc986181&ipo=images', new \DateTimeImmutable(), 'Ma description', 'SCH', ['rap']],
            ['Album_3', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages-na.ssl-images-amazon.com%2Fimages%2FI%2F91NQO2l3RZL._SL1500_.jpg&f=1&nofb=1&ipt=3a84754e4487cf41b08d67d1fcf7d7aa561ee927f1efa2b8248eb050cc986181&ipo=images', new \DateTimeImmutable(), 'Ma description', 'SCH', ['rap']],
        ];
    }

    public function getDependencies(): array
    {
        return [
            ArtistFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
