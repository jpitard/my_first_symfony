<?php

namespace AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AdminBundle\Entity\Product;

class LoadProductData extends AbstractFixture  implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        for ($i=0; $i <= 10; $i++)
        {

            $product = new Product();
            $product->setTitle('testLoad'.$i);
            $product->setDescription('description test load'.$i);
            $product->setPrice(12+$i);
            $product->setQuantity(5+$i);
            $product->setMarque($this->getReference('brand'.$i));
            for ($j=0; $j < 3; $j++){

                $product->addCategory($this->getReference('category'.$j));

            }


            $manager->persist($product);
            $manager->flush();

            $this->addReference('product'.$i, $product);


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
       return 3;
    }
}