<?php

namespace AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AdminBundle\Entity\Comment;

class LoadCommentData extends AbstractFixture  implements OrderedFixtureInterface
{
    const MAX_NB_PRODUCTS =50;

    public function load(ObjectManager $manager){

        $faker = \Faker\Factory::create();


        for ($i=0; $i < self::MAX_NB_PRODUCTS; $i++)
        {
            $product = $this->getReference('product'.$i);

            for ($i=0; $i <= 5 ; $i++) {
                $comment = new Comment();
                $comment->setAuthor($faker->name);
                $comment->setContent($faker->text(300));
                $comment->setScore(rand(1,5));
                $comment->setProduct($product);

                $this->addReference('comment' . $i, $comment);
            }
        }
        $manager->flush();
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