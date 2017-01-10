<?php

namespace AdminBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    public function myFindAll() {

        // Creation d'une requête DQL
        // findAll() maison
        $query = $this->getEntityManager()
            ->createQuery('
                    	  SELECT prod
                          FROM AdminBundle:Product prod
                    ');
        //die(dump($query->getResult()));


//        $query = $this->getEntityManager()->createQueryBuilder()
//            ->select("prod")
//            ->from("AdminBundle:Product", "prod")
//            ->getQuery();
//
//        die(dump($query->getResult()));
        die($query);
    }


    public function myFind($id) {

        // Creation d'une requête DQL
        // find() maison
        $query = $this->getEntityManager()
            ->createQuery('
                    			SELECT prod
                          FROM AdminBundle:Product prod
                          WHERE prod.id = :identifiant
                    ')
            ->setParameter('identifiant', $id);

        die(dump($query->getScalarResult()));

        /* Plusieurs paramètres
        ->setParameters([
                'identifiant' => $id,
            'autre_variable' => $autre
        ])
        */

        //die(dump($query->getResult()));

        // Création d'une requête grâce au builder
        // findAll() maison
       /* $query = $this->getEntityManager()->createQueryBuilder()
            ->select("prod")
            ->from("AdminBundle:Product", "prod")
            ->getQuery();*/

        //die(dump($query->getResult()));

        //return $query->getResult();
    }
    public function myFindInfFive() {

        $query = $this->getEntityManager()
            ->createQuery('
                    			SELECT prod
                          FROM AdminBundle:Product prod
                          WHERE prod.quantity < 10
                          
                    ');
        die(dump($query->getResult()));

    }

    public function myFindProductCountQuantZero() {

        $query = $this->getEntityManager()
            ->createQuery('
                    	  SELECT count(prod)
                          FROM AdminBundle:Product prod
                          WHERE prod.quantity = 0
                    ');
        die(dump($query->getResult()));

    }
    public function myFindQuantityTotal() {

        $query = $this->getEntityManager()
            ->createQuery('
                    	  SELECT  SUM(prod.quantity)
                          FROM AdminBundle:Product prod
                          
                    ');
        die(dump($query->getResult()));

    }

    public function myFindPrixMaxAndMin() {

        $query = $this->getEntityManager()
            ->createQuery('
                    	  SELECT  MAX(prod.price) 
                          FROM AdminBundle:Product prod
                          
                    ');
        die(dump($query->getResult()));

    }





}
