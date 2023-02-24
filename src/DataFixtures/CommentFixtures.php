<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            /** @var User $user */
            $user = $this->getReference($data[2]);
            /** @var Album $album */
            $album = $this->getReference($data[3]);

            $comment = new Comment();
            $comment
                ->setContent($data[0])
                ->setNote($data[1])
                ->setUser($user)
                ->setAlbum($album)
            ;

            $manager->persist($comment);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            ['Commentaire 1', 3, 'user', 'Album_1'],
            ['Commentaire 2', 2, 'admin', 'Album_1'],
            ['Commentaire 1', 5, 'user', 'Album_2'],
            ['Commentaire 2', 3, 'admin', 'Album_2'],
        ];
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
