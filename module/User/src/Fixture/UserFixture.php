<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 06/01/2019
 * Time: 16:04
 */

namespace User\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use User\Entity\User;

class UserFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("armandojrn@hotmail.com");
        $user->setFullName("Armando Nascimento Junior");
        $user->setPassword(password_hash('123456', PASSWORD_DEFAULT));
        $manager->persist($user);
        $manager->flush();
    }
}