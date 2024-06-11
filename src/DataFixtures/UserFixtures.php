<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $user = (new User());
        $user->setRoles(['ROLE_ADMIN'])
            ->setEmail('admin@atph.fr')
            ->setUsername('admin')
            ->setIsVerified(true)
            ->setPassword($this->hasher->hashPassword($user, 'admin'))
            ->setApiToken('admin_token');

        $manager->persist($user);
        $manager->flush();


        for ($i = 1; $i <=10; $i++) {
            $user->setRoles ([])
            ->setEmail("user {$i} @atph.fr")
            ->setUsername("user {$i}")
            ->setIsVerified(true)
            ->setPassword($this->hasher->hashPassword($user, '0000'))
            ->setApiToken("user{$i}");
            $manager->persist ($user);
            }
    }


    
}
