<?php

namespace App\DataFixtures;

use App\Entity\Group;
use App\Entity\User;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * Undocumented variable
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        // create admin user
        $user = new User();
        $hashed_password = $this->encoder->encodePassword($user, 'admin');
        $user->setFirstName($faker->firstName())
            ->setLastName($faker->lastName())
            ->setEmail('admin@admin.com')
            ->setPhone($faker->phoneNumber())
            ->setRoles(['ROLE_ADMIN'])
            ->setType('admin')
            ->setPassword($hashed_password)
            ->setAge($faker->unique()->numberBetween(20, 60));
        $manager->persist($user);

        // creation des groupes


        for ($g = 0; $g < mt_rand(2, 3); $g++) {

            $group = new Group();
            $group->setName("groupe_$g");
            $group->setDescription($faker->realText(mt_rand(60, 100)));

            $manager->persist($group);
        // creation des users

            for ($u = 0; $u < 5; $u++) {
                $user = new User();
                $hash = $this->encoder->encodePassword($user, 'password');
                $user->setFirstName($faker->firstName())
                    ->setLastName($faker->lastName)
                    ->setEmail($faker->email)
                    ->setPhone($faker->phoneNumber())
                    ->setPassword($hash)
                    ->setRoles(['ROLE_USER'])
                    ->setType($faker->randomElement(['devops', 'testeur', 'developpeur']))
                    ->setAge($faker->unique()->numberBetween(20, 60));
                $user->addGroup($group);
                $manager->persist($user);
            }
        }



        $manager->flush();
    }
}
