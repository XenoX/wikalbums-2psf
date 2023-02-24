<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $artist = new Artist();
            $artist
                ->setName($data[0])
                ->setPhoto($data[1])
                ->setCountry($data[2])
                ->setDateOfBirth($data[3])
            ;

            $this->addReference($data[0], $artist);

            $manager->persist($artist);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            ['SCH', 'https://generations.fr/media/news/sch1-19336.png', 'FR', new \DateTime('12/31/2000')],
            ['Ziak', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse2.mm.bing.net%2Fth%3Fid%3DOIP.stmR3ARFPfhdUKaBtZIUHQHaGM%26pid%3DApi&f=1&ipt=785584fc83b1d528cf2e481314f0fa14f3c4a96e21686cee6e29d0d404d752a6&ipo=images', 'FR', new \DateTime('12/31/2010')],
        ];
    }
}
