<?php

namespace AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AdminBundle\Entity\Brand;

class LoadBrandData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        for ($i=0; $i <= 10; $i++)
        {
            $brand = new Brand();
            $brand->setTitle('brand'.$i);




            $manager->persist($brand);
            $manager->flush();

            $this->addReference('brand'.$i, $brand);


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

        return 2;
    }
}