<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Coach;
use App\Entity\Programme;
use App\Entity\Seance;
use App\Enum\roleAccountEnum;
use App\Enum\statusSeanceEnum;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('elwardi@hotmail.com');
        $admin->setFirstName('abderrazzak');
        $admin->setLastName('elwardi');
        $admin->setIsBanned(false);
        $admin->setRole(roleAccountEnum::ADMIN);
        $admin->setPassword('ok123456');
        $manager->persist($admin);

        $user = new User();
        $user->setEmail('esgi@myges.fr');
        $user->setFirstName('esgi');
        $user->setLastName('paris');
        $user->setRole(roleAccountEnum::USER);
        $user->setIsBanned(false);
        $user->setPassword('ok123456');
        $manager->persist($user);

        $banned = new User();
        $banned->setEmail('paris@myges.fr');
        $banned->setFirstName('paris');
        $banned->setLastName('esgi');
        $banned->setRole(roleAccountEnum::BANNED);
        $banned->setIsBanned(true);
        $banned->setPassword('bannedpass');
        $manager->persist($banned);

        $coach = new Coach();
        $coach->setSpeciality('Fitness');
        $coach->setDescription('Coach de fitness avec 10 ans d\'expérience.');
        $coach->setUsere($admin);
        $manager->persist($coach);

        $programme = new Programme();
        $programme->setTitle('Programme 1');
        $programme->setDescription('Programme de fitness pour débutants.');
        $programme->setCoach($coach);
        $manager->persist($programme);

        $seance = new Seance();
        $seance->setUsere($user);
        $seance->setDate(new \DateTime('2023-10-01'));
        $seance->setProgramme($programme);
        $seance->setStatus(statusSeanceEnum::PENDING);
        $manager->persist($seance);

        $manager->flush();
    }
}
