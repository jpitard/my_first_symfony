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

        for ($i=0; $i < count($tabBrand); $i++)
        {
            $brand = new Brand();
            $brand->setTitle($tabBrand[$i]);

            $manager->persist($brand);

            $this->addReference($tabBrand[$i], $brand);
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

        return 2;
    }
}