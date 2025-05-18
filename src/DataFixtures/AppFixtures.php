<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Coach;
use App\Entity\Programme;
use App\Entity\Seance;
use App\Enum\statusSeanceEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('elwardi@gmail.com');
        $user->setFirstName('Abderrazzak');
        $user->setLastName('Elwardi');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, 'ok123456')
        );
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('esgi@myges.fr');
        $user2->setFirstName('Esgi');
        $user2->setLastName('Paris');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword(
            $this->passwordHasher->hashPassword($user2, 'ok123456')
        );
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('banned@myges.fr');
        $user3->setFirstName('banned');
        $user3->setLastName('banned');
        $user3->setRoles(['BANNED']);
        $user3->setPassword(
            $this->passwordHasher->hashPassword($user3, 'ok123456')
        );
        $manager->persist($user3);

        $coach = new Coach();
        $coach->setFullName('Abderrazzak Elwardi');
        $coach->setSpeciality('Développeur Symfony');
        $coach->setDescription('Je suis un développeur Symfony passionné par le développement web.');
        $coach->setSlug('abderrazzak-elwardi');
        $coach->setUsere($user);
        $manager->persist($coach);

        $programme = new Programme();
        $programme->setTitle('Programme de développement Symfony');
        $programme->setDescription('Ce programme est conçu pour vous aider à devenir un expert en Symfony.');
        $programme->setImage('https://images.unsplash.com/photo-1506744038136-46273834b3fb');
        $programme->setSlug('programme-de-developpement-symfony');
        $programme->setCoach($coach);
        $manager->persist($programme);

        $seance = new Seance();
        $seance->setDate(new \DateTime('2025-05-20'));
        $seance->setStartAt(new \DateTime('10:00'));
        $seance->setEndAt(new \DateTime('11:00'));
        $seance->setStatus(statusSeanceEnum::PENDING);
        $seance->setProgramme($programme);
        $manager->persist($seance);

        $seance2 = new Seance();
        $seance2->setDate(new \DateTime('2025-05-21'));
        $seance2->setStartAt(new \DateTime('14:00'));
        $seance2->setEndAt(new \DateTime('15:00'));
        $seance2->setStatus(statusSeanceEnum::IN_PROGRESS);
        $seance2->setProgramme($programme);
        $manager->persist($seance2);

        $manager->flush();
    }
}
