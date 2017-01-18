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

        $faker = \Faker\Factory::create();

        $tabCategory = [
            'peinture',
            'sculpture',
            'photographie',
            'arts numériques',
            'média mixtes',
            'artisanat d\'art',
            'gravures et estampes',
            'calligraphies',
            'design',
            'dessin'
        ];

        for ( $i=0; $i > count($tabCategory); $i++){

            $category = new Category();
            $category->setTitle($tabCategory[$i]);
            $category->setDescription($faker->text(250));
            $category->setPosition(rand(1,10));
            $category->setActive(rand(0,1));

            $manager->persist($category);

            $this->addReference($tabCategory[$i], $category);

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

        return 1;
    }
}