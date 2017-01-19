<?php

namespace AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AdminBundle\Entity\Product;

class LoadProductData extends AbstractFixture  implements OrderedFixtureInterface
{
    const MAX_NB_PRODUCTS =20;

    public function load(ObjectManager $manager){

        $faker = \Faker\Factory::create();
        $tabBrand = [
            'Yuliya Mochalina',
            'Friedrich Dandl',
            'Denis Levin ',
            'boitmel',
            'Kirstin McCoy',
            'Miro Gradinšćak',
            'Aleksandra Nosacheva',
            'Thierry Prouvost',
            'Marcelo Novo',
            'Stephane Bazabas',
            'ChA ',
            'Marie FISCHER',
            'REV',
            'David Chevallier'
        ];

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


        for ($i=0; $i < self::MAX_NB_PRODUCTS; $i++)
        {

            $product = new Product();
            $product->setTitle($faker->title);
            $product->setDescription($faker->text(250));
            $product->setPrice($faker->randomFloat(2,0,1000));
            $product->setQuantity($faker->randomDigit);
            $product->setImage($faker->image());

            //die(dump($tabBrand[13], $tabCategory[9]));
            $product->setMarque($this->getReference($tabBrand[rand(0,13)]));
            //$product->addCategory($tabCategory[rand(0,9)]);
            $product->addCategory($this->getReference($tabCategory[rand(0,9)]));
            $manager->persist($product);
           // die(dump($tabBrand[rand(0,13)], $tabCategory[rand(0,9)]));
            $this->addReference('product'.$i, $product);
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
       return 3;
    }
}

