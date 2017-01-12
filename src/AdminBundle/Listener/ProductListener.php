<?php
/**
 * Created by PhpStorm.
 * User: test
 * Date: 12/01/2017
 * Time: 09:49
 */

namespace AdminBundle\Listener;


use AdminBundle\Entity\Product;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class ProductListener
{
    public function postPersist(Product $entity, LifecycleEventArgs $args){
       /* dump($entity); exit;

        $entity->set*/


    }
    public function prePersist(Product $entity, LifecycleEventArgs $args){
        //dump($entity); exit;
        $now = new \DateTime();
        $entity->setCreatedAT($now);
        $entity->setUpdatedAt($now);
        //dump($entity); exit;

    }

    public function preUpdate(Product $entity, PreUpdateEventArgs $event){
        //dump($entity); exit;
        $now = new \DateTime();
        $entity->setUpdatedAt($now);
        //dump($entity); exit;

    }
}