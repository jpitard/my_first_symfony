<?php

namespace AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AdminBundle\Entity\Product;

class LoadProductData extends AbstractFixture  implements OrderedFixtureInterface
{
    const MAX_NB_PRODUCTS =50;

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
            'David Chevallier',
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
        //die(dump($tabBrand, $tabCategory));
        for ($i=0; $i < self::MAX_NB_PRODUCTS; $i++)
        {

            $product = new Product();
            $product->setTitleEN($faker->title);
            $product->setTitleFR($faker->title);
            $product->setDescriptionEN($faker->text(250));
            $product->setDescriptionFR($faker->text(250));
            $product->setPrice($faker->randomFloat(2,0,1000));
            $product->setQuantity($faker->randomDigit);
            $product->setImage("default.jpeg");
            $product->setCreatedAT($faker->dateTime);
            $product->setUpdatedAt($faker->dateTime);
            $product->setMarque($this->getReference($tabBrand[rand(0,13)]));
            //$product->addCategory($tabCategory[rand(0,9)]);
            $product->addCategory($this->getReference($tabCategory[rand(0,9)]));
            $manager->persist($product);

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

