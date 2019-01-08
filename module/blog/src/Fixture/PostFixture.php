<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 06/01/2019
 * Time: 16:04
 */

namespace Blog\Fixture;

use Blog\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (range(1,20) as $value) {
            $post = new Post();
            $post->setTitle("Title $value");
            $post->setContent("Content $value");
            $manager->persist($post);
        }
        $manager->flush();
    }
}