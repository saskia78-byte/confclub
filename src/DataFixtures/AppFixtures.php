<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\ConfFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // ── Thème de test ──
        $theme = new \App\Entity\Theme();
        $theme->setLibelle('Informatique');
        $manager->persist($theme);

        // ── Conférencier de test ──
        $conferencier = new \App\Entity\Conferencier();
        $conferencier->setNom('Dupont');
        $conferencier->setPrenom('Jean');
        $manager->persist($conferencier);

        // ── User de test ──
        $user = new User();
        $user->setEmail('admin@test.com');
        $user->setNom('Lillo');
        $user->setPrenom('Emma');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword(
            $this->hasher->hashPassword($user, 'password123')
        );
        $manager->persist($user);
        $manager->flush();

        ConfFactory::createMany(5);
    }
}
