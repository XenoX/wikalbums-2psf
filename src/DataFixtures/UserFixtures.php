<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->getData() as $data) {
            $user = new User();

            $hashedPassword = $this->passwordHasher->hashPassword($user, $data[1]);

            $user
                ->setUsername($data[0])
                ->setPassword($hashedPassword)
                ->setRoles($data[2])
            ;

            $this->addReference($data[0], $user);

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getData(): array
    {
        return [
            ['user', 'panda', []],
            ['admin', 'panda', ['ROLE_ADMIN']],
        ];
    }
}
