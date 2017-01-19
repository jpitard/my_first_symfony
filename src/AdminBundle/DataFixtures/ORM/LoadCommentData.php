<?php

namespace AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AdminBundle\Entity\Comment;

class LoadCommentData extends AbstractFixture  implements OrderedFixtureInterface
{
    const MAX_NB_PRODUCTS =25;

    public function load(ObjectManager $manager){

        $faker = \Faker\Factory::create();


        for ($i=0; $i < self::MAX_NB_PRODUCTS; $i++)
        {
            $product = $this->getReference('product'.$i);
           // $nbComment = rand(1,10);
           // $nbComment = 2;


                $comment = new Comment();
                $comment->setAuthor($faker->name);
                $comment->setContent($faker->text(300));
                $comment->setScore(rand(1,5));
                $comment->setProduct($product);

                $manager->persist($comment);

            $manager->flush();
        }

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
       return 4;
    }
}