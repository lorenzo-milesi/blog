<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($usersCounter = 0 ; $usersCounter < 10 ; $usersCounter++) {
            $user = new User();
            $hash = $this->encoder->encodePassword($user, 'password');
            $user->setEmail($faker->safeEmail)
                ->setPassword($hash);

            $manager->persist($user);

            for ($postsCounter = 0 ; $postsCounter < random_int(0, 5) ; $postsCounter++) {
                $post = (new Post())
                    ->setAuthor($user)
                    ->setTitle($faker->sentence)
                    ->setContent($faker->realText(300));

                $manager->persist($post);
            }
        }

        $manager->flush();
    }
}
