<?php

namespace AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AdminBundle\Entity\Category;

class LoadCategoryData extends  AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        for ($i=0; $i <= 10; $i++)
        {
            $category = new Category();
            $category->setTitle('category'.$i);
            $category->setDescription('descriptionCategory'.$i);
            $category->setPosition(rand(1,10));
            $category->setActive(rand(0,1));

            $manager->persist($category);
            $manager->flush();

            $this->addReference('category'.$i, $category);


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

        return 1;
    }
}